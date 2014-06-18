<?php defined('C5_EXECUTE') or die('Access denied.');
$form = Loader::helper('form');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
<h3><?php echo t('Add / edit event') ?></h3>


<?php if(empty($calendars) && $event_ID === null): ?>
    <div class="alert alert-info">
        There is no calendars to add new event. Go to Add calendar to add new calendar.
    </div>
<?php else: ?>


<div class="btn-group" style="margin-top: 10px;">
    <a class="btn" href="<?php echo View::url('dashboard/event_calendar/list_event') ?>">Return to event list</a>
</div>

<form class="form-horizontal" method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">
    <fieldset class="control-group">
        <label class="control-label"><?php echo t('Event title') ?></label>

        <div class="controls">
            <input type="text" name="event_title" id="event_title" value="<?php echo $event_title; ?>">
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label"><?php echo t('Calendar') ?></label>

        <div class="controls">
            <select name="event_calendarID" id="event_calendarID" value="<?php echo $event_calendarID; ?>">
                <?php foreach ($calendars as $cal): ?>
                    <option value="<?php echo $cal['calendarID'] ?>"><?php echo $cal['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label"><?php echo t('Event date') ?></label>

        <div class="controls">
            <input type="text" name="event_date" id="event_date" value="<?php echo $event_date; ?>">
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label"><?php echo t('Event type') ?></label>

        <div class="controls">
            <input type="text" name="event_type" id="event_type" value="<?php echo $event_type; ?>">
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label"><?php echo t('Event description') ?></label>

        <div class="controls">
            <input type="text" name="event_description" id="event_description"
                   value="<?php echo $event_description; ?>">
        </div>
    </fieldset>
    <fieldset class="control-group">
        <label class="control-label"><?php echo t('Event url') ?></label>

        <div class="controls">
            <input type="text" name="event_url" id="event_url" value="<?php echo $event_url; ?>">
        </div>
    </fieldset>
    <fieldset class="control-group offset2">
        <div class="clearfix">
            <div style="margin-top: 10px;">
                <input class="<?php echo $button['class'] ?>" type="submit" value="<?php echo $button['label'] ?>">
            </div>
        </div>
    </fieldset>
</form>

<script>
    $(document).ready(function () {
        $('#event_date').datetimepicker({
            lang: 'pl',
            dateFormat: "yy-mm-dd H:i",
            todayButton: true,
            dayOfWeekStart: 1
        }).datepicker('setDate', new Date());
    });
</script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>


