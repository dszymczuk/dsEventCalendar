<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<input type="text" name="calendarID" value="<?php echo $calendarID; ?>"/>

<fieldset>
    <label for="calendarID"><?php echo t('Calendar') ?></label>

    <div style="margin-top: 15px;">
        <select name="calendarID" id="calendarID">
            <?php foreach ($calendars as $cal): ?>
                <option
                    value="<?php echo $cal['calendarID'] ?>" <?php if ($calendarID == $cal['calendarID']) echo "selected" ?>><?php echo $cal['title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</fieldset>