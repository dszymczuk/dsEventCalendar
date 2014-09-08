<?php defined('C5_EXECUTE') or die('Access denied.'); ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>

<?php echo $type; ?>

    <div class="alert alert-success" id="success" style="display: none">
        <?php echo t('Type has been deleted') ?>
    </div>
    <div class="alert alert-danger" id="error" style="display: none">
        <?php echo t('Something wrong in delete. Try again') ?>
    </div>

    <h3><?php echo t('List of types') ?></h3>

    <table id="typelist" class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th><?php echo t('Type name') ?></th>
            <th><?php echo t('Color') ?></th>
            <th><?php echo t('Count of evetns with type') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th><?php echo t('Type name') ?></th>
            <th><?php echo t('Color') ?></th>
            <th><?php echo t('Count of evetns with type') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($types as $t): ?>
            <tr>
                <td><input class="typeID" type="hidden" value="<?php echo $t['typeID']; ?>"><?php echo $t['type']; ?>
                </td>
                <td>
                    <span class="badge" style="background-color: <?php echo $t['color']; ?> ;">
                        <?php echo $t['color']; ?>
                    </span>
                </td>
                <td>
                    <?php if ($t['count'] > 0): ?>
                        <span class="badge badge-important"><?php echo $t['count']; ?></span>
                    <?php else: ?>
                        <span class="badge badge-success">0</span>
                    <?php endif; ?>
                </td>
                <td><a href="<?php echo View::url('dashboard/event_calendar/types/update/' . $t['typeID']) ?>"
                       class="btn btn-warning edit"><?php echo t('Edit') ?></a>
<!--                    <button class="btn btn-danger delete">--><?php //echo t('Delete') ?><!--</button>-->
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>



<form class="form-horizontal" method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">
        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Type name') ?></label>

            <div class="controls">
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
                    <input class="btn btn-success" type="submit" value="<?php echo t('Add type') ?>">
                </div>
            </div>
        </fieldset>
    </form>


<script>
$(document).ready(function () {
	$('#color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$('#color').val('#'+hex);
			$(el).hide();
		}
	});

    /*$("tr").on('click', 'button.delete', function () {
        var elem = $(this);
        var conf = confirm("Are you sure to delete this event?");
        if (conf) {
            var id = elem.closest('tr').children('td').children('input.eventID').val();
            elem.closest('tr').addClass('toRemove');
            $.ajax({
                type: "POST",
                url: "<?php echo $this->url('dashboard/event_calendar/list_event/delete'); ?>",
                data: {"id": id},
                success: function (data) {
                    if (data == "OK") {
                        $("#success").fadeIn(1000).delay(2000).fadeOut(1000);
                        listevent.fnDeleteRow(elem.closest('tr'));
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
    });*/

});
</script>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper();