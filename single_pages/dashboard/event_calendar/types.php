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
a
    <table id="typeevent" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th><?php echo t('Type name') ?></th>
            <th><?php echo t('Color') ?></th>
            <th><?php echo t('Count of evetns whit type') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th><?php echo t('Type name') ?></th>
            <th><?php echo t('Color') ?></th>
            <th><?php echo t('Count of evetns whit type') ?></th>
            <th><?php echo t('Options') ?></th>
        </tr>
        </tfoot>

        <tbody>
        <?php
        var_dump($types);
        ?>
        <?php foreach ($types as $t): ?>
            <tr>
                <td><input class="typeID" type="hidden" value="<?php echo $e['typeID']; ?>"><?php echo $e['type']; ?>
                </td>
                <td><?php echo $e['color']; ?></td>
                <td>
                    <span class="badge badge-success"><?php echo $e['count'] == '' ? 0 : $e['count']; ?></span>
                </td>
                <td><a href="<?php echo View::url('dashboard/event_calendar/types/update/' . $e['typeID']) ?>"
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
});
</script>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper();