<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<?php if (empty($calendars)): ?>
    <div class="alert alert-info">
        <?php echo t('No calendar exist. Add from one from dashboard.') ?>
    </div>
<?php else: ?>
    <div style="margin-top: 10px;">
        <fieldset>
            <label for="calendarID"><?php echo t('Select calendar') ?></label>

            <div style="margin-top: 10px;">
                <select name="calendarID" id="calendarID">
                    <?php foreach ($calendars as $cal): ?>
                        <option
                            value="<?php echo $cal['calendarID'] ?>" <?php if ($calendarID == $cal['calendarID']) echo "selected" ?>><?php echo $cal['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>

        <fieldset style="margin-top: 10px;">
            <label for="lang"><?php echo t('Select language') ?></label>

            <div style="margin-top: 10px;">
                <select name="lang" id="lang">
                    <?php foreach ($langs as $l): ?>
                        <option
                            value="<?php echo $l ?>" <?php if ($lang == $l) echo "selected" ?>><?php echo $l ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>
    </div>
<?php endif; ?>