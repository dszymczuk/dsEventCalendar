<?php defined('C5_EXECUTE') or die('Access denied.'); ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>

<h3><?php echo t('Settings') ?></h3>




			lang
			date format
			date format 2
			start from day
			default event name
			defautl event color

<form class="form-horizontal" method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Event title') ?></label>
	    <div class="controls">
	        <input maxlength="255" type="text" name="event_title" id="event_title" value="<?php echo $event_title; ?>">
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