<?php defined('C5_EXECUTE') or die('Access denied.');
$form = Loader::helper('form');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>

<div class="dsMenu">
    <div class="btn-toolbar">
        <div class="btn-group">
            <a class="btn btn-primary" href="<?php echo View::url('dashboard/event_calendar/list_calendar') ?>"><?php echo t('Calendars list'); ?>&nbsp;/&nbsp;<?php echo t('Manage events'); ?></a>
        </div>
        <div class="btn-group">
            <a class="btn btn-success" href="<?php echo View::url('dashboard/event_calendar/calendar') ?>"><?php echo t('Add / edit calendar'); ?></a>
            <a class="btn btn-success" href="<?php echo View::url('dashboard/event_calendar/event') ?>"><?php echo t('Add / edit event'); ?></a>
        </div>
        <div class="btn-group">
            <a class="btn" href="<?php echo View::url('dashboard/event_calendar/types') ?>"><?php echo t('Type of events'); ?></a>
            <a class="btn" href="<?php echo View::url('dashboard/event_calendar/settings') ?>"><?php echo t('Settings'); ?></a>
        </div>
    </div>
</div>

<h3><?php echo t('Add / edit event') ?></h3>

<?php if (empty($calendars) && ( !isset( $event_ID ) || $event_ID === null)): ?>
    <div class="alert alert-info">
        <?php echo t(' There are no calendars to add a new event. Go to Add calendar to add a new calendar.') ?>
    </div>
<?php else: ?>
    
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
                <button class="btn btn-primary desc"><?php echo t('Description') ?></button>
                <button class="btn url"><?php echo t('URL') ?></button>
            </div>
        </fieldset>

        <fieldset class="control-group event_type">
            <label class="control-label"><?php echo t('Event type') ?></label>

            <div class="controls">
                <button class="btn btn-primary allday"><?php echo t('All day (multiday)') ?></button>
                <button class="btn withtime"><?php echo t('One day with time') ?></button>
            </div>
        </fieldset>

        <div class="row">
            <div class="span3">
                <fieldset class="control-group">
                    <label class="control-label"><?php echo t('Event start date') ?> *</label>

                    <div class="controls">
                        <input class="span3" maxlength="255" type="text" name="event_start_date" id="event_start_date" value="<?php echo ( isset( $event_start_date ) ) ? $event_start_date : ''; ?>">
                    </div>
                </fieldset>

            </div>
            <div class="offset2 span2">
                <fieldset class="control-group event_withtime">
                    <label class="control-label"><?php echo t('Event start time') ?></label>

                    <div class="controls">
                        <input class="span3" maxlength="255" type="text" name="event_start_time" id="event_start_time" value="<?php echo ( isset( $event_start_time ) ) ? $event_start_time : ''; ?>">
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="row">
            <div class="span3">
                <fieldset class="control-group">
                    <label class="control-label"><?php echo t('Event end date') ?> *</label>

                    <div class="controls">
                        <input class="span3" maxlength="255" type="text" name="event_end_date" id="event_end_date" value="<?php echo ( isset( $event_end_date ) ) ? $event_end_date : ''; ?>">
                    </div>
                </fieldset>

            </div>
            <div class="offset2 span2">
                <fieldset class="control-group event_withtime">
                    <label class="control-label"><?php echo t('Event end time') ?></label>

                    <div class="controls">
                        <input class="span3" maxlength="255" type="text" name="event_end_time" id="event_end_time" value="<?php echo ( isset( $event_end_time ) ) ? $event_end_time : ''; ?>">
                    </div>
                </fieldset>
            </div>
        </div>

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
            var allDayEvent = true;

            var dateConfig = {
                lang: '<?php echo $lang_datepicker ?>',
                format: "d F Y",
                todayButton: true,
                dayOfWeekStart: 1,
                timepicker:false,
                closeOnDateSelect:true,
                scrollTime: <?php echo $scrollTime == '1' ? 'true' : 'false' ?>,
                scrollMonth: <?php echo $scrollMonth == '1' ? 'true' : 'false' ?>,
                scrollInput: <?php echo $scrollInput == '1' ? 'true' : 'false' ?>,
                onSelectDate: function(ct){
                    var date = new Date(ct);
                    if(allDayEvent) {
                        $("#event_end_date").val(moment(date).format("DD MMMM YYYY"));
                    }
                }
            };

            var timeConfig = {
                datepicker: false,
                lang: '<?php echo $lang_datepicker ?>',
                format: "H:i",
                step: 30
            };

            $('#event_start_date').datetimepicker(dateConfig).datepicker('setDate', new Date());
            $('#event_end_date').datetimepicker(dateConfig).datepicker('setDate', new Date());

            $('#event_start_time').datetimepicker(timeConfig).datepicker('setDate', new Date());
            $('#event_end_time').datetimepicker(timeConfig).datepicker('setDate', new Date());


            // minimal end date and time

            $('#event_start_date').change(function(){
                var eed = $('#event_end_date');
                if(!allDayEvent) {
                    eed.val("");
                }
                eed.datetimepicker({
                    minDate: $('#event_start_date').val(),
                    formatDate: "d F Y"
                });
            });


            $('#event_start_time').change(function(){
                var eet = $('#event_end_time');
                eet.val("");
                eet.datetimepicker({
                    minTime: $('#event_start_time').val(),
                    formatTime: "H:i"
                });
            });

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
                $("input#event_end_date").prop('disabled', false);
                allDayEvent = false;

                $("input#event_start_time").val('');
                $("input#event_end_time").val('');
            }

            function setWithTimeButton() {
                button_allday.removeClass('btn-primary');
                $('.event_withtime').show();
                button_wittime.addClass('btn-primary');
                $("input#event_end_date").val($('input#event_start_date').val()).prop('disabled',true );
                allDayEvent = true;
            }

            if ($('#event_start_time').val() == '')
                setAllDayButton();
            else
                setWithTimeButton();

        });
    </script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>
