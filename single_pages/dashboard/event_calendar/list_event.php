<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>

<div class="dsMenu">
    <div class="btn-toolbar">
        <div class="btn-group">
            <a class="btn btn-primary"
               href="<?php echo View::url('dashboard/event_calendar/list_calendar') ?>"><?php echo t('Calendars list'); ?>
                &nbsp;/&nbsp;<?php echo t('Manage events'); ?></a>
        </div>
        <div class="btn-group">
            <a class="btn btn-success"
               href="<?php echo View::url('dashboard/event_calendar/calendar') ?>"><?php echo t('Add / edit calendar'); ?></a>
            <a class="btn btn-success"
               href="<?php echo View::url('dashboard/event_calendar/event') ?>"><?php echo t('Add / edit event'); ?></a>
        </div>
        <div class="btn-group">
            <a class="btn"
               href="<?php echo View::url('dashboard/event_calendar/types') ?>"><?php echo t('Type of events'); ?></a>
            <a class="btn"
               href="<?php echo View::url('dashboard/event_calendar/settings') ?>"><?php echo t('Settings'); ?></a>
        </div>
    </div>
</div>

<h3><?php echo t('List of events') ?></h3>

<?php if (empty($events)): ?>
    <div class="margin-top-10"></div>
    <div class="alert alert-info">
        <?php echo t('There is no events. Go to Add event to add new event.') ?>
    </div>
<?php else: ?>

    <div id="dsEventCalendar">
        <!--[if lte IE 9]>
        <div class="ds-event-modal ie8 ie9" id="dsEventModal"><![endif]-->
        <!--[if !IE]><!-->
        <div class="ds-event-modal" id="dsEventModal"><!--<![endif]-->


            <div class="container">
                <div class="header">
                    <div class="title"></div>
                </div>
                <div class="content">
                    <div class="time"></div>
                    <div class="description form-horizontal">
                        <fieldset class="control-group">
                            <label class="control-label"><?php echo t('Event title') ?>  *</label>

                            <div class="controls">
                                <input maxlength="255" type="text" name="event_title" id="event_title"
                                       value="">
                            </div>
                        </fieldset>


                        <div class="row">
                            <div class="span3">
                                <fieldset class="control-group">
                                    <label class="control-label"><?php echo t('Event start date') ?> *</label>

                                    <div class="controls">
                                        <input class="span3" maxlength="255" type="text" name="event_start_date"
                                               id="event_start_date" value="">
                                    </div>
                                </fieldset>

                            </div>
                            <div class="offset2 span2">
                                <fieldset class="control-group event_withtime">
                                    <label class="control-label"><?php echo t('Event start time') ?></label>

                                    <div class="controls">
                                        <input class="span3" maxlength="255" type="text" name="event_start_time"
                                               id="event_start_time" value="">
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="row">
                            <div class="span3">
                                <fieldset class="control-group">
                                    <label class="control-label"><?php echo t('Event end date') ?> *</label>

                                    <div class="controls">
                                        <input class="span3" maxlength="255" type="text" name="event_end_date"
                                               id="event_end_date" value="">
                                    </div>
                                </fieldset>

                            </div>
                            <div class="offset2 span2">
                                <fieldset class="control-group event_withtime">
                                    <label class="control-label"><?php echo t('Event end time') ?></label>

                                    <div class="controls">
                                        <input class="span3" maxlength="255" type="text" name="event_end_time"
                                               id="event_end_time" value="">
                                    </div>
                                </fieldset>
                            </div>
                        </div>


                        <fieldset class="control-group">
                            <label class="control-label"><?php echo t('Event type') ?> *</label>

                            <div class="controls">
                                <?php $event_type = isset($event_type) ? $event_type : null; ?>
                                <select name="event_type" id="event_type" value="<?php echo $event_type; ?>">
                                    <option value="0"><?php echo t("Default"); ?></option>

                                    <?php foreach ($types as $t): ?>
                                        <option value="<?php echo $t['typeID'] ?>"><?php echo $t['type'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </fieldset>

                        <div class="alert alert-info">
                            <p class="event_url"><?php echo t('If you set URL info type, after click on event it will redirct to URL. Window with details will NOT show! Description will be erase.'); ?></p>

                            <p class="event_description"><?php echo t('If you set Description info type, after click on event it will show window with details.'); ?></p>
                        </div>

                        <fieldset class="control-group event_info_type">
                            <label class="control-label"><?php echo t('Event info type') ?> *</label>

                            <div class="controls">
                                <button class="btn btn-primary desc"><?php echo t('Description') ?></button>
                                <button class="btn url"><?php echo t('URL') ?></button>
                            </div>
                        </fieldset>


                        <fieldset class="control-group event_description">
                            <label class="control-label"><?php echo t('Event description') ?></label>

                            <div class="controls">
                                <textarea rows="5" name="event_description"
                                          id="event_description"></textarea>
                            </div>
                        </fieldset>
                        <fieldset class="control-group event_url" style="display: none;">
                            <label class="control-label"><?php echo t('Event url') ?></label>

                            <div class="controls">
                                <input maxlength="255" type="text" name="event_url" id="event_url"
                                       value="">
                            </div>

                        </fieldset>
                    </div>
                </div>
                <div id="update_message" class="alert">

                </div>
                <div class="footer">
                    <div class="buttons">
                        <div class="pull-left btn btn-danger"><?php echo t("Remove") ?></div>
                        <div class="btn btn-close"><?php echo t("Close") ?></div>
                        <div class="pull-right btn btn-success btn-update"><?php echo t("Update") ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            var dsEventCalendar = $("#dsEventCalendar");
            var modal = $("#dsEventModal");

            var updateMessage = $("#update_message");
            var eventClicked = {};

            var settings = {};
            var set_serv = <?php echo $settings; ?>;

            if (!Object.keys) {
                Object.keys = function (obj) {
                    var keys = [];

                    for (var i in obj) {
                        if (obj.hasOwnProperty(i)) {
                            keys.push(i);
                        }
                    }

                    return keys;
                };
            }

            for (var key in set_serv) {
                var value = set_serv[key];
                var k = Object.keys(value);
                var v = value[k];
                settings[k] = v;
            }

            var button_desc = $('.event_info_type button.desc');
            var button_url = $('.event_info_type button.url');

            button_desc.click(function () {
                setDescriptionButton();
            });

            button_url.click(function () {
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


            var calendarID = 0;
            var eventID = 0;

            dsEventCalendar.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: "month,agendaWeek"
                },
                slotDuration: "00:30:00",
                defaultTimedEventDuration: "00:30:00",
                timeFormat: settings.timeFormat,
                eventLimit: false,
                eventClick: function (calEvent, jsEvent, view) {
                    eventClicked = calEvent;

                    if (calEvent.description == "" || calEvent.description == null)
                        setURLButton();

                    if (calEvent.url == "" || calEvent.url == null)
                        setDescriptionButton();

                    var start_day = calEvent.start.format(settings.formatEvent);
                    var end_day = "";
                    if (calEvent.end != null)
                    {
                        if(calEvent.allDayEvent == 1)
                    	    calEvent.end.subtract(1,'days');

                        end_day = " - " + calEvent.end.format(settings.formatEvent);
                    }


                    modal.find('.header .title').text(calEvent.title);

                    if (calEvent.allDayEvent == 0) {
                        //with time
                        start_day = calEvent.start.format(settings.timeFormat);
                        end_day = "";
                        if (calEvent.end != null)
                        {
                            end_day = " - " + calEvent.end.format(settings.timeFormat);
                        	end_day += " " + calEvent.end.format(settings.formatEvent);
                        }

                    }
                    else {
                        //witout time
                        start_day = calEvent.start.format(settings.formatEvent);
                        end_day = "";
                        if (calEvent.end != null)
                            end_day = " - " + calEvent.end.format(settings.formatEvent);
                    }

                    modal.find('.content .time').text(start_day + end_day);

                    modal.find('input#event_title').val(calEvent.title);



                    modal.find("#event_start_date").val(calEvent.start.format(settings.formatEvent));
                    if (calEvent.end == null)
                    {
                    	modal.find("#event_end_date").val(calEvent.start.format(settings.formatEvent));
                    }
                    else
                    {
                    	modal.find("#event_end_date").val(calEvent.end.format(settings.formatEvent));
                    }

                    modal.find(".event_withtime").css('display', 'none');
                    modal.find("#event_end_date").prop('disabled', false);
                    if (calEvent.allDayEvent == '0') {
                        modal.find(".event_withtime").css('display', 'block');
                        modal.find("#event_start_time").val(calEvent.start.format(settings.timeFormat));
                        if (calEvent.end != null)
                            modal.find("#event_end_time").val(calEvent.end.format(settings.timeFormat));

                        modal.find("#event_end_date").prop('disabled', true);
                    }

                    var dateConfig = {
                        lang: 'en',
                        format: "d F Y",
                        todayButton: true,
                        dayOfWeekStart: 1,
                        timepicker: false,
                        closeOnDateSelect: true,
                        onSelectDate: function (ct) {
                            var date = new Date(ct);
                            if (calEvent.allDayEvent == '0') {
                                modal.find("#event_end_date").val(moment(date).format(settings.formatEvent));
                            }
                        }
                    };

                    var timeConfig = {
                        datepicker: false,
                        lang: 'en',
                        format: "H:i",
                        step: 30
                    };


                    $('#event_start_date').datetimepicker(dateConfig);

                    var dateConfigEnd = dateConfig;
                    dateConfigEnd.minDate = $('#event_start_date').val();
                    dateConfigEnd.formatDate = "d F Y";

                    $('#event_end_date').datetimepicker(dateConfigEnd);

                    $('#event_start_time').datetimepicker(timeConfig);

                    var timeConfigEnd = timeConfig;
                    timeConfigEnd.minTime = $('#event_start_time').val();
                    timeConfigEnd.formatTime = "H:i";

                    $('#event_end_time').datetimepicker(timeConfigEnd);

                    // minimal end date and time

                    $('#event_start_date').change(function(){
                        var eed = $('#event_end_date');
                        if(calEvent.allDayEvent != '0') {
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

                    modal.find('textarea#event_description').val(calEvent.description);
                    modal.find('input#event_url').val(calEvent.url);

                    var select_event_type = $("select#event_type option");

                    if (calEvent.typeID != null) {
                        select_event_type.filter(function () {
                            return $(this).val() == calEvent.typeID;
                        }).attr('selected', true);

                    }
                    else {
                        select_event_type.first().attr('selected', true);
                    }

                    calendarID = calEvent.calendarID;
                    eventID = calEvent.eventID;

                    modal.addClass('active');

                    if (calEvent.url != "")
                        return false;

                },
                editable: true,
                eventSources: [
                    {
                        url: '<?php echo $this->action("getEvents");?>',
                        type: 'GET',
                        data: {
                            'calendarid': '<?php echo $calendarID; ?>'
                        }
                    }
                ],
                eventDrop: function (event, delta, revertFunc, jsEvent, ui, view) {
                    var newEventDate = event.start.subtract(delta).add(delta).format("YYYY-MM-DD HH:mm:ss");

                    var event_data = {
                        calendarID: event.calendarID,
                        eventID: event.eventID,
                        eventDate: newEventDate
                    };

                    if (event.end)
                        event_data.eventEnd = event.end.subtract(delta).add(delta).format("YYYY-MM-DD HH:mm:ss");

                    $.ajax({
                        type: "post",
                        url: '<?php echo $this->action("updateDateEventa");?>',
                        data: event_data,
                        success: function (data) {
                            dsEventCalendar.fullCalendar('refetchEvents');
                        },
                        error: function () {
                            console.warn("error");
                        }
                    });

                },
                eventResize: function (event, delta, revertFunc, jsEvent, ui, view) {

                    var event_data = {
                        calendarID: event.calendarID,
                        eventID: event.eventID
                    };

                    if (event.addDayEvent == "0")
                        event_data.eventEnd = event.end.subtract(delta).add(delta).format("YYYY-MM-DD");
                    else
                        event_data.eventEnd = event.end.subtract(delta).add(delta).format("YYYY-MM-DD HH:mm:ss");

                    $.ajax({
                        type: "post",
                        url: '<?php echo $this->action("updateDateEventRange");?>',
                        data: event_data,
                        success: function (data) {
                            dsEventCalendar.fullCalendar('refetchEvents');
                        },
                        error: function () {
                            console.warn("error");
                        }
                    });

                },
                lang: settings.lang,
                firstDay: settings.startFrom
            });

            $("#dsEventModal .btn-close").on('click', function () {
                dsEventCalendar.fullCalendar('refetchEvents');
                $(this).closest(".ds-event-modal").removeClass('active');
            });

            $("#dsEventModal .btn-danger").on('click', function () {

                $.ajax({
                    type: "post",
                    url: '<?php echo $this->action("removeEvent");?>',
                    data: {eventID: eventID},
                    success: function (data) {
                        if (data == "OK") {
                            updateMessage.addClass('alert-success');
                            updateMessage.text("<?php echo t('Event has been removed') ?>");
                            updateMessage.fadeIn(500, function () {
                                dsEventCalendar.fullCalendar('refetchEvents');
                            }).delay(2000).fadeOut(500, function () {
                                updateMessage.text("");
                                updateMessage.removeClass('alert-success');
                                $(this).closest(".ds-event-modal").removeClass('active');
                            });
                        }
                        else {
                            updateMessage.addClass('alert-error');
                            updateMessage.text("<?php echo t('Error while remove event. Try again.') ?>");
                            updateMessage.fadeIn(500).delay(2000).fadeOut(500, function () {
                                updateMessage.text("");
                                updateMessage.removeClass('alert-error');
                            });
                        }
                    },
                    error: function () {
                        console.warn("error");
                    }
                });

            });

            $("#dsEventModal .btn-update").click(function () {

                var event_data = {
                    calendarID: calendarID,
                    eventID: eventID,
                    eventTitle: $("#event_title").val(),
                    eventStartDate: $("#event_start_date").val(),
                    eventStartTime: $("#event_start_time").val(),
                    eventEndDate: $("#event_end_date").val(),
                    eventEndTime: $("#event_end_time").val(),
                    eventType: $("#event_type").val(),
                    eventDescription: $("#event_description").val(),
                    eventURL: $("#event_url").val()
                };

                if (button_desc.hasClass('btn-primary'))
                    event_data.eventURL = "";


                if (button_url.hasClass('btn-primary'))
                    event_data.eventDescription = "";

                $.ajax({
                    type: "post",
                    url: '<?php echo $this->action("updateEvent");?>',
                    data: event_data,
                    success: function (data) {
                        if (data == "OK") {
                            updateMessage.addClass('alert-success');
                            updateMessage.text("<?php echo t('Event has been updated') ?>");
                            updateMessage.fadeIn(500, function () {
                                eventClicked.title = event_data.eventTitle;
                                eventClicked.date = event_data.eventDate;
                                eventClicked.typeID = event_data.eventType;
                                eventClicked.description = event_data.eventDescription;
                                eventClicked.url = event_data.eventURL;
                                dsEventCalendar.fullCalendar('refetchEvents');
                            }).delay(2000).fadeOut(500, function () {
                                updateMessage.text("");
                                updateMessage.removeClass('alert-success');
                                $(this).closest(".ds-event-modal").removeClass('active');
                            });
                        }
                        else {
                            updateMessage.addClass('alert-error');
                            updateMessage.text("<?php echo t('Error while update event. Try again.') ?>");
                            updateMessage.fadeIn(500).delay(2000).fadeOut(500, function () {
                                updateMessage.text("");
                                updateMessage.removeClass('alert-error');
                            });
                        }
                    },
                    error: function () {
                        console.warn("error");
                    }
                });

            });

        });
    </script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>
