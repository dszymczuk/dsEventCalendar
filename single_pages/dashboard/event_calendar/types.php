<?php defined('C5_EXECUTE') or die('Access denied.'); ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>

    <div class="dsMenu">
        <div class="btn-toolbar">
            <div class="btn-group">
                <a class="btn btn-primary" href="<?php echo View::url('dashboard/event_calendar/list_calendar') ?>"><?php echo t('Calendars list'); ?>&nbsp;/&nbsp;<?php echo t('Manage events'); ?></a>
            </div>
            <div class="btn-group">
                <a class="btn btn-success" href="<?php echo View::url('dashboard/event_calendar/calendar') ?>"><?php echo t('Add / edit calendar'); ?></a>
                <a class="btn btn-success" href="<?php echo View::url('dashboard/event_calendar/event') ?>"><?php echo t('Add / edit event'); ?></a>
            </div>
            <div class="btn-group">
                <a class="btn" href="<?php echo View::url('dashboard/event_calendar/types') ?>"><?php echo t('Type of events'); ?></a>
                <a class="btn" href="<?php echo View::url('dashboard/event_calendar/settings') ?>"><?php echo t('Settings'); ?></a>
            </div>
        </div>
    </div>


    <h3><?php echo t('List of types') ?></h3>

    <div class="alert alert-success" id="success" style="display: none">
        <?php echo t('Type has been deleted') ?>
    </div>
    <div class="alert alert-danger" id="error" style="display: none">
        <?php echo t('Something wrong in delete. Try again') ?>
    </div>


    <table id="typelist" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th><?php echo t('Type name') ?></th>
            <th><?php echo t('Color') ?></th>
            <th><?php echo t('Count of events with type') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th><?php echo t('Type name') ?></th>
            <th><?php echo t('Color') ?></th>
            <th><?php echo t('Count of events with type') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($types as $t): ?>
            <tr>
                <td><input class="typeID" type="hidden" value="<?php echo $t['typeID']; ?>">
                    <span class="type"><?php echo $t['type']; ?></span>
                </td>
                <td>
                    <span class="badge color" style="background-color: <?php echo $t['color']; ?> ;">
                        <?php echo $t['color']; ?>
                    </span>
                </td>
                <td>
                    <?php if ($t['total_types'] > 0): ?>
                        <span class="badge badge-important"><?php echo $t['total_types']; ?></span>
                    <?php else: ?>
                        <span class="badge badge-success">0</span>
                    <?php endif; ?>
                </td>
                <td><button class="btn btn-warning edit"><?php echo t('Edit') ?></button>
                    <button class="btn btn-danger delete"><?php echo t('Delete') ?></button>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>


<div class="alert alert-success" id="success-edit" style="display: none">
    <?php echo t('Type has been edited') ?>
</div>
<div class="alert alert-danger" id="error-edit" style="display: none">
    <?php echo t('Something wrong in edit. Try again') ?>
</div>


<form class="form-horizontal" method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">
        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Type name') ?></label>

            <div class="controls">
                <input maxlength="255" type="hidden" name="typeID" id="typeID" value="">
                <input maxlength="255" type="text" name="type" id="type" value="<?php echo $type; ?>">
            </div>
        </fieldset>

        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Color') ?></label>

            <div class="controls">
                <input maxlength="255" type="text" name="color" id="color" value="<?php echo $color; ?>">
            </div>
        </fieldset>
        <fieldset class="control-group offset2">
            <div class="clearfix">
                <div style="margin-top: 10px;">
                    <input class="btn btn-success" id="submit-add" type="submit" value="<?php echo t('Add type') ?>">
                    <button class="btn btn-success" style="display: none;" id="submit-new" ><?php echo t('Add new') ?></button>
                    <button class="btn btn-warning" style="display: none;" id="submit-edit" ><?php echo t('Edit type') ?></button>
                </div>
            </div>
        </fieldset>
    </form>


<script>
$(document).ready(function () {
    var editMode = false;
    showButtons();

	$('#color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$('#color').val('#'+hex);
			$(el).hide();
		}
	});

    $("tr").on('click', 'button.edit', function (){
        editMode = true;
        showButtons();
        var elem = $(this);
        var id = elem.closest('tr').children('td').children('input.typeID').val();
        var color = elem.closest('tr').find('td span.color').html().trim();
        var type = elem.closest('tr').find('td span.type').html().trim();

        $('#typeID').val(id);
        $('#type').val(type);
        $('#color').val(color);

        $('#color').ColorPickerSetColor(color);
    });

    $("#submit-new").on('click',function(){
        editMode = false;
        showButtons();
    });

    $("#submit-edit").on('click',function(e){
        e.preventDefault();
        var id = $('#typeID').val();
        var color = $('#color').val();
        var type = $('#type').val();
        $.ajax({
            type: "POST",
            url: "<?php echo $this->url('dashboard/event_calendar/types/update'); ?>",
            data: {"id": id, "color" : color , "type" : type},
            success: function (data) {
                if (data == "OK") {
                    $("#success-edit").fadeIn(1000).delay(2000).fadeOut(1000);
                    var row = $("#typelist").find("input[value="+id+"]").closest('tr');
                    row.find('td span.color').html(color.trim()).css("background-color",color);
                    row.find('td span.type').html(type.trim());
                    editMode = false;
                    $('#typeID').val("");
                    $('#type').val("");
                    $('#color').val("");
                    $('#color').ColorPickerSetColor("");
                }
                else {
                    $("#error-edit").fadeIn(1000).delay(2000).fadeOut(1000);
                }

            }
        });
    });


    function showButtons(){
        if(editMode)
        {
            $("#submit-edit").show();
            $("#submit-new").show();
            $("#submit-add").hide();
        }
        else
        {
            $("#submit-edit").hide();
            $("#submit-new").hide();
            $("#submit-add").show();
        }
    };

    $("tr").on('click', 'button.delete', function () {
        var elem = $(this);
        var conf = confirm('<?php echo t("Are you sure to delete this type? All event with this type will be set as default type."); ?>');
        if (conf) {
            var id = elem.closest('tr').children('td').children('input.typeID').val();
            elem.closest('tr').addClass('toRemove');

            $.ajax({
                type: "POST",
                url: "<?php echo $this->url('dashboard/event_calendar/types/delete'); ?>",
                data: {"id": id},
                success: function (data) {
                    if (data == "OK") {
                        $("#success").fadeIn(1000).delay(2000).fadeOut(1000);
                        $('#typeID').val("");
                        $('#type').val("");
                        $('#color').val("");
                        $('#color').ColorPickerSetColor("");
                        $("#typelist").find("input[value="+id+"]").closest('tr').remove();
                    }
                    else {
                        $("#error").fadeIn(1000).delay(2000).fadeOut(1000);
                    }

                }
            });
        }
        else
            return false;
    });

});
</script>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper();
