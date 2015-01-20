<?php defined('C5_EXECUTE') or die('Access denied.');
$form = Loader::helper('form');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>
<h3><?php echo t('Add / edit event') ?></h3>


<?php if (empty($calendars) && ( !isset( $event_ID ) || $event_ID === null)): ?>
    <div class="alert alert-info">
        <?php echo t('There is no calendars to add new event. Go to Add calendar to add new calendar.') ?>
    </div>
<?php else: ?>
    <div class="btn-group" style="margin-top: 10px;">
        <a class="btn"
           href="<?php echo View::url('dashboard/event_calendar/list_event') ?>"><?php echo t('Return to event list') ?></a>
    </div>

    <form class="form-horizontal" method="post" id="ccm-multilingual-page-report-form" style="margin-top: 35px;">
        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Event title') ?>  *</label>

            <div class="controls">
                <input maxlength="255" class="span6" type="text" name="event_title" id="event_title" value="<?php echo ( isset( $event_title ) ) ? $event_title : ''; ?>">
            </div>
        </fieldset>
        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Calendar') ?> *</label>

            <div class="controls">
                <?php $event_calendarID = isset( $event_calendarID ) ? $event_calendarID : null; ?>
                <select class="span6" name="event_calendarID" id="event_calendarID" value="<?php echo $event_calendarID; ?>">
                    <?php foreach ($calendars as $cal): ?>
                        <option value="<?php echo $cal['calendarID'] ?>" <?php $selected = $cal['calendarID']==$event_calendarID ? "selected" : ""; echo $selected; ?> ><?php echo $cal['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>

        <div class="row">
            <div class="controls">
                <div class="span6 alert alert-info">
                    <p class="event_url"><?php echo t('If you set URL info type, after click on event it will redirct to URL. Window with details will NOT show! Description will be erase.'); ?></p>
                    <p class="event_description"><?php echo t('If you set Description info type, after click on event it will show window with details.'); ?></p>
                </div>
            </div>
        </div>

        <fieldset class="control-group event_info_type">
            <label class="control-label"><?php echo t('Event info type') ?></label>

            <div class="controls">
                <button class="btn btn-primary desc">Description</button>
                <button class="btn url">URL</button>
            </div>
        </fieldset>

        <fieldset class="control-group event_type">
            <label class="control-label"><?php echo t('Event type') ?></label>

            <div class="controls">
                <button class="btn btn-primary allday">All day (multiday)</button>
                <button class="btn withtime">1 day with time</button>
            </div>
        </fieldset>

        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Event date') ?> *</label>

            <div class="controls">
                <input class="span6" maxlength="255" type="text" name="event_date" id="event_date" value="<?php echo ( isset( $event_date ) ) ? $event_date : ''; ?>">
            </div>
        </fieldset>
        <fieldset class="control-group event_withtime">
            <label class="control-label"><?php echo t('Event time') ?></label>

            <div class="controls">
                <input class="span6" maxlength="255" type="text" name="event_time" id="event_time" value="<?php echo ( isset( $event_time ) ) ? $event_date : ''; ?>">
            </div>
        </fieldset>

        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Event type - color') ?> *</label>

            <div class="controls">
                <?php $event_type = isset( $event_type ) ? $event_type : null; ?>
                <select class="span6" name="event_type" id="event_type" value="<?php echo $event_type; ?>">
                    <?php foreach ($types as $t): ?>
                        <option value="<?php echo $t['typeID'] ?>" <?php $selected = $t['typeID']==$event_type ? "selected" : ""; echo $selected; ?> ><?php echo $t['type'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>
        <fieldset class="control-group event_description">
            <label class="control-label"><?php echo t('Event description') ?> *</label>

            <div class="controls">
                                <textarea class="span6" rows="5" name="event_description"
                                          id="event_description"><?php echo (isset($event_description)) ? $event_description : ''; ?></textarea>
            </div>
        </fieldset>
        <fieldset class="control-group event_url" style="display: none;">
            <label class="control-label"><?php echo t('Event url') ?> *</label>

            <div class="controls">
                <input maxlength="255" type="text" name="event_url" id="event_url"
                       value="<?php echo (isset($event_url)) ? $event_url : ''; ?>">
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
                lang: 'en',
                format: "Y-m-d",
                todayButton: true,
                dayOfWeekStart: 1,
                timepicker:false,
                closeOnDateSelect:true
            }).datepicker('setDate', new Date());

            $('#event_time').datetimepicker({
                datepicker: false,
                lang: 'en',
                format: "H:i",
                step: 30
            }).datepicker('setDate', new Date());

            var button_desc = $('.event_info_type button.desc');
            var button_url = $('.event_info_type button.url');

            button_desc.click(function (e) {
                e.preventDefault();
                setDescriptionButton();
            });

            button_url.click(function (e) {
                e.preventDefault();
                setURLButton();
            });

            function setURLButton() {
                button_url.addClass('btn-primary');
                $('.event_url').show();
                $('.event_description').hide();
                button_desc.removeClass('btn-primary');
            }

            function setDescriptionButton() {
                button_desc.addClass('btn-primary');
                $('.event_description').show();
                $('.event_url').hide();
                button_url.removeClass('btn-primary');
            }

            setDescriptionButton();


            var button_allday = $('.event_type button.allday');
            var button_wittime = $('.event_type button.withtime');

            button_allday.click(function (e) {
                e.preventDefault();
                setAllDayButton();
            });

            button_wittime.click(function (e) {
                e.preventDefault();
                setWithTimeButton();
            });

            function setAllDayButton() {
                button_wittime.removeClass('btn-primary');
                $('.event_withtime').hide();
                button_allday.addClass('btn-primary');
            }

            function setWithTimeButton() {
                button_allday.removeClass('btn-primary');
                $('.event_withtime').show();
                button_wittime.addClass('btn-primary');
            }

            setAllDayButton();

        });
    </script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>
