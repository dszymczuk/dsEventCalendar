<?php defined('C5_EXECUTE') or die('Access denied.'); ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>

<h3><?php echo t('Settings') ?></h3>

<form class="form-horizontal" method="post" id="ccm-multilingual-page-report-form" style="margin-top: 15px;">

	<fieldset class="control-group">
        <label class="control-label"><?php echo t('Language') ?></label>

        <div class="controls">
            <select name="lang" id="lang" value="<?php echo $lang; ?>">
                <?php foreach ($lang_list as $ll): ?>
                    <option value="<?php echo $ll; ?>" <?php $selected = $ll==$lang ? "selected" : ""; echo $selected; ?> ><?php echo $ll; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Title date format') ?></label>
	    <div class="controls">
	        <input maxlength="255" type="text" name="formatTitle" id="formatTitle" value="<?php echo $formatTitle; ?>">
	    </div>
	</fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Event date format') ?></label>
	    <div class="controls">
	        <input maxlength="255" type="text" name="formatEvent" id="formatEvent" value="<?php echo $formatEvent; ?>">
	    </div>
	</fieldset>

	<fieldset class="control-group">
	    <!-- <label class="control-label"></label> -->
	    <div class="controls">
	        <a href="http://momentjs.com/docs/#/displaying/format/" class="btn btn-primary" target="_blank">Available formats</a>
	    </div>
	</fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Start from') ?></label>
	    <div class="controls">
            <select name="startFrom" id="startFrom" value="<?php echo $startFrom; ?>">
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
	        <input maxlength="255" type="text" name="eventsInDay" id="eventsInDay" value="<?php echo $eventsInDay; ?>">
	    </div>
	</fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Default name of event') ?></label>
	    <div class="controls">
	        <input maxlength="255" type="text" name="default_name" id="default_name" value="<?php echo $default_name; ?>">
	    </div>
	</fieldset>

	<fieldset class="control-group">
	    <label class="control-label"><?php echo t('Default color of event') ?></label>
	    <div class="controls">
	        <input maxlength="255" type="text" name="default_color" id="default_color" value="<?php echo $default_color; ?>">
	    </div>
	</fieldset>

	<fieldset class="control-group offset2">
        <div class="clearfix">
            <div style="margin-top: 10px;">
                <input class="btn btn-success" id="submit-update" type="submit" value="<?php echo t('Update settings') ?>">
            </div>
        </div>
    </fieldset>
</form>

<hr>

<p><?php echo t('Author:') ?>Damian Szymczuk</p>
<p><?php echo t('Site:') ?><a target="_blank" href="http://dszymczuk.pl">dszymczuk.pl</a></p>
<p><?php echo t('Project on GitHub:') ?><a target="_blank" href="https://github.com/dszymczuk/dsEventCalendar">dsEventCalendar</a></p>
<p><?php echo t('Do you like it? Maybe some donate? :)') ?></p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="CREWJUVCCFC5C">
<input type="image" src="https://www.paypalobjects.com/pl_PL/PL/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal — Płać wygodnie i bezpiecznie">
<img alt="" border="0" src="https://www.paypalobjects.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
</form>


<script>
$(document).ready(function () {

	$('#default_color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$('#default_color').val('#'+hex);
			$(el).hide();
		}
	});

	var default_color = $('#default_color').val();
    $('#default_color').ColorPickerSetColor(default_color);


});
</script>


<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper();