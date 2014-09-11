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
        <label class="control-label"><?php echo t('Language') ?></label>

        <div class="controls">
            <select name="language" id="language" value="<?php echo $lang; ?>">
                <?php foreach ($lang_list as $ll): ?>
                    <option value="<?php echo $ll; ?>" <?php $selected = $ll==$lang ? "selected" : ""; echo $selected; ?> ><?php echo $ll; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Title date format') ?></label>
	    <div class="controls">
	        <input maxlength="255" type="text" name="title_format" id="title_format" value="<?php echo $formatTitle; ?>">
	    </div>
	</fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Event date format') ?></label>
	    <div class="controls">
	        <input maxlength="255" type="text" name="event_format" id="event_format" value="<?php echo $formatEvent; ?>">
	    </div>
	</fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Start from') ?></label>
	    <div class="controls">
            <select name="start_day" id="start_day" value="<?php echo $startFrom; ?>">
            	<?php $index = 1; ?>
                <?php foreach ($days as $d): ?>
                	
                    <option value="<?php echo $index%7 ?>" <?php $selected = $index%7==$startFrom ? "selected" : ""; echo $selected; ?> ><?php echo $d ?></option>
                	<?php $index++; ?>
                <?php endforeach; ?>
            </select>
        </div>
	</fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Number of evetns in day') ?></label>
	    <div class="controls">
	        <input maxlength="255" type="text" name="events_in_day" id="events_in_day" value="<?php echo $eventsInDay; ?>">
	    </div>
	</fieldset>

</form>



$this->set('lang','en');
			$this->set('formatTitle','MMMM YYYY');
			$this->set('formatEvent','DD MMMM YYYY');
			$this->set('startFrom',1); //0 - Sunday, 1 - Monday etc.
			$this->set('eventsInDay',3);

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