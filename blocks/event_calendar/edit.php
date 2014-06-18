<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<?php if(empty($calendars)): ?>
    <div class="alert alert-info">
        No calendar exist. Add from one from dashboard.
    </div>
<?php else: ?>
    <div style="margin-top: 15px;">
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
    </div>
<?php endif; ?>