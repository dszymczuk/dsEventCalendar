<?php defined('C5_EXECUTE') or die('Access denied.'); ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>











<form class="form-horizontal" method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">
        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Type of event') ?></label>

            <div class="controls">
                <input maxlength="255" type="text" name="type_of_event" id="type_of_event" value="<?php echo $type_of_event; ?>">
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
			console.log(el);
			$('#color').val('#'+hex);
			$(this).hide();
		}
	});
});
</script>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper();