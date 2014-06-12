<?php defined('C5_EXECUTE') or die('Access denied.');
$form = Loader::helper('form');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
    <h3><?php echo t('Add / edit event') ?></h3>


    <div class="btn-group" style="margin-top: 15px;">
        <a class="btn" href="<?php echo View::url('dashboard//event_calendar/list_event') ?>">Return to event list</a>
    </div>

    <form method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">
        <fieldset>
            <label><?php echo t('Event title') ?></label>
            <div style="margin-top: 15px;">
                <input type="text" name="event_title" id="event_title" value="<?php echo $event_title; ?>">
            </div>
        </fieldset>

        <fieldset>
            <label><?php echo t('Calendar') ?></label>
            <div style="margin-top: 15px;">
                <select name="event_calendarID" id="event_calendarID" value="<?php echo $event_calendarID; ?>">
                    <?php foreach($calendars as $cal): ?>
                    <option value="<?php echo $cal['calendarID'] ?>"><?php echo $cal['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>

        <fieldset>
            <label><?php echo t('Event date') ?></label>
            <div style="margin-top: 15px;">
                <input type="text" name="event_date" id="event_date" value="<?php echo $event_date; ?>">
            </div>
        </fieldset>
        <fieldset>
            <label><?php echo t('Event type') ?></label>
            <div style="margin-top: 15px;">
                <input type="text" name="event_type" id="event_type" value="<?php echo $event_type; ?>">
            </div>
        </fieldset>
        <fieldset>
            <label><?php echo t('Event description') ?></label>
            <div style="margin-top: 15px;">
                <input type="text" name="event_description" id="event_description" value="<?php echo $event_description; ?>">
            </div>
        </fieldset>
        <fieldset>
            <label><?php echo t('Event url') ?></label>
            <div style="margin-top: 15px;">
                <input type="text" name="event_url" id="event_url" value="<?php echo $event_url; ?>">
            </div>
        </fieldset>

        <fieldset>
            <div class="clearfix">
                <div style="margin-top: 10px;">
                    <input class="btn" type="submit" value="<?php echo t('Add event') ?>">
                </div>
            </div>
        </fieldset>
    </form>

<script>
    $(document).ready(function(){
        $('#event_date').datepicker({
            dateFormat: "yy-mm-dd",
            firstDay: 1
        }).datepicker('setDate', new Date());
    });
</script>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>


