<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>


<h3><?php echo t('List of events') ?></h3>


<?php if (empty($events)): ?>
    <div class="margin-top-10"></div>
    <div class="alert alert-info">
        <?php echo t('There is no events. Go to Add event to add new event.') ?>
    </div>
<?php else: ?>

    <div id="dsEventCalendar">
        <div class="ds-drop-trash" id="dsEventCalendarTrash">
            <?php echo t('Drop here to remove event'); ?>
        </div>
        <div class="ds-event-modal" id="dsEventModal">
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
                                       value="<?php echo (isset($event_title)) ? $event_title : ''; ?>">
                            </div>
                        </fieldset>
                        <fieldset class="control-group">
                            <label class="control-label"><?php echo t('Event (start) date') ?> *</label>

                            <div class="controls">
                                <input maxlength="255" type="text" name="event_date" id="event_date"
                                       value="<?php echo (isset($event_date)) ? $event_date : ''; ?>">
                            </div>
                        </fieldset>
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
                                <button class="btn btn-primary desc">Description</button>
                                <button class="btn url">URL</button>
                            </div>
                        </fieldset>


                        <fieldset class="control-group event_description">
                            <label class="control-label"><?php echo t('Event description') ?></label>

                            <div class="controls">
                                <textarea rows="5" name="event_description"
                                          id="event_description"><?php echo (isset($event_description)) ? $event_description : ''; ?></textarea>
                            </div>
                        </fieldset>
                        <fieldset class="control-group event_url" style="display: none;">
                            <label class="control-label"><?php echo t('Event url') ?></label>

                            <div class="controls">
                                <input maxlength="255" type="text" name="event_url" id="event_url"
                                       value="<?php echo (isset($event_url)) ? $event_url : ''; ?>">
                            </div>

                        </fieldset>
                    </div>
                </div>
                <div id="update_message" class="alert">

                </div>
                <div class="footer">
                    <div class="buttons">
                        <div class="btn btn-close"><?php echo t("Close") ?></div>
                        <div class="btn btn-success btn-update"><?php echo t("Update") ?></div>
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
            var dateInput = $('#event_date');

            var trashElement = $('#dsEventCalendarTrash');

            var settings = {};
            var set_serv = <?php echo $settings; ?>;

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
                timeFormat: "HH:mm",
                eventLimit: false,
                eventClick: function (calEvent, jsEvent, view) {
                    eventClicked = calEvent;


                    if (calEvent.description == "" || calEvent.description == null)
                        setURLButton();

                    if (calEvent.url == ""|| calEvent.url == null)
                        setDescriptionButton();

                    var start_day = calEvent.start.format(settings.formatEvent);
                    var end_day = "";
                    if (calEvent.end != null)
                        end_day = " - " + calEvent.end.format(settings.formatEvent);


                    modal.find('.header .title').text(calEvent.title);
                    modal.find('.content .time').text(start_day + end_day);

                    modal.find('input#event_title').val(calEvent.title);

                    modal.find('input#event_date').val(calEvent.date);
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
                eventDragStart: function (event, jsEvent, ui, view) {
                    console.log("eventDragStart");
                    trashElement.addClass('active');
                },
                eventDragRemove:function(event,jsEvent){
                    console.log("eventDragRemove");
                    var ofs = trashElement.offset();
                    var x1 = ofs.left;
                    var x2 = ofs.left + trashElement.outerWidth(true);
                    var y1 = ofs.top;
                    var y2 = ofs.top + trashElement.outerHeight(true);

                    if (jsEvent.pageX >= x1 && jsEvent.pageX<= x2 &&
                            jsEvent.pageY>= y1 && jsEvent.pageY <= y2) {

                        dsEventCalendar.fullCalendar('removeEvents', event._id);

                        $.ajax({
                            type: "post",
                            url: '<?php echo $this->action("removeEvent");?>',
                            data: {eventID: event._id},
                            success: function (data) {
                                if (data == "OK") {
                                    trashElement.addClass('success');
                                    trashElement.text("Event has been deleted.");
                                    trashElement.delay(1000).fadeOut(500,function(){
                                        trashElementRestore();
                                    });
                                }
                                else
                                {
                                    trashElement.addClass('error');
                                    trashElement.text("<?php echo t('Error while update event. Try again.') ?>");
                                    trashElement.delay(1000).fadeOut(500,function(){
                                        trashElementRestore();
                                    });
                                }
                            },
                            error: function () {
                                console.warn("error");
                            }
                        });

                        function trashElementRestore(){
                            trashElement.text('<?php echo t('Drop here to remove event'); ?>');
                            trashElement.removeClass('success');
                            trashElement.removeClass('error');
                            trashElement.removeClass('active');
                        }

                    }
                },
                eventDrop: function( event, delta, revertFunc, jsEvent, ui, view ) {
                    console.log("eventDrop");
                    console.log(event);

//                    var newEventEnd = "";

                    var newEventDate = event.start.subtract(delta).add(delta).format("YYYY-MM-DD HH:mm:ss");

//                    if(!(event.end == null || event.end == ""))
//                        newEventEnd = event.end.subtract(delta).add(delta).format("YYYY-MM-DD HH:mm:ss");


                    var event_data = {
                        calendarID: event.calendarID,
                        eventID: event.eventID,
                        eventDate: newEventDate
                    };

                    if(event.end)
                    {
                        event_data.eventEnd = event.end.subtract(delta).add(delta).format("YYYY-MM-DD HH:mm:ss");
                    }




                    console.log(event_data);


                    $.ajax({
                        type: "post",
                        url: '<?php echo $this->action("updateDateEventRange");?>',
                        data: event_data,
                        success: function (data) {
                            console.log(data);
                            if (data == "OK") {
                            }
                            else
                            {
//                                dsEventCalendar.fullCalendar('refetchEvents');
                            }
                        },
                        error: function () {
                            console.warn("error");
                        }
                    });

                },
                eventDragStop: function(event,jsEvent) {
                    console.log("eventDragStop");

                    trashElement.removeClass('active');
                },
                lang: settings.lang,
                firstDay: settings.startFrom
            });

            $("#dsEventModal .btn-close").on('click', function () {
                $(this).closest(".ds-event-modal").removeClass('active');
            });

            $("#dsEventModal .btn-update").click(function () {

                var event_data = {
                    calendarID: calendarID,
                    eventID: eventID,
                    eventTitle: $("#event_title").val(),
                    eventDate: $("#event_date").val(),
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

            dateInput.datetimepicker({
                lang: 'en',
                format: "Y-m-d H:i:s",
                step: 15,
                todayButton: true,
                dayOfWeekStart: 1
            });
        });
    </script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>
