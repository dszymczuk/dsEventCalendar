<?php defined('C5_EXECUTE') or die('Access denied.');
?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Event Calendar')); ?>


    <h3><?php echo t('List of events') ?></h3>


<?php if (empty($events)): ?>
    <div class="alert alert-info">
        <?php echo t('There is no events. Go to Add event to add new event.') ?>
    </div>
<?php else: ?>

    <div id="dsEventCalendar">
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
                <input maxlength="255" type="text" name="event_title" id="event_title" value="<?php echo ( isset( $event_title ) ) ? $event_title : ''; ?>">
            </div>
        </fieldset>
        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Event date') ?> *</label>

            <div class="controls">
                <input maxlength="255" type="text" name="event_date" id="event_date" value="<?php echo ( isset( $event_date ) ) ? $event_date : ''; ?>">
            </div>
        </fieldset>
        <fieldset class="control-group">
            <label class="control-label"><?php echo t('Event type') ?> *</label>

            <div class="controls">
                <?php $event_type = isset( $event_type ) ? $event_type : null; ?>
                <select name="event_type" id="event_type" value="<?php echo $event_type; ?>">
                    <option value="0"><?php echo t("Default"); ?></option>

                    <?php foreach ($types as $t): ?>
                        <option value="<?php echo $t['typeID'] ?>"><?php echo $t['type'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>

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
                <textarea name="event_description" id="event_description"><?php echo ( isset( $event_description ) ) ? $event_description : ''; ?></textarea>
            </div>
        </fieldset>
        <fieldset class="control-group event_url" style="display: none;">
            <label class="control-label"><?php echo t('Event url') ?></label>

            <div class="controls">
                <input maxlength="255" type="text" name="event_url" id="event_url" value="<?php echo ( isset( $event_url ) ) ? $event_url : ''; ?>">
            </div>

        </fieldset>
                    </div>
                </div>
                <div class="footer">
                    <div class="buttons">
                        <div class="btn btn-close"><?php echo t("Close") ?></div>
                        <div class="btn btn-success btn-update"><?php echo t("Udpate") ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            var modal = $("#dsEventModal");


            var events = <?php echo $events; ?>;
            var settings = {};
            var set_serv = <?php echo $settings; ?>;

            for(var key in set_serv) {
                var value = set_serv[key];
                var k = Object.keys(value);
                var v = value[k];
                settings[k] = v;
            }

            // console.info(events);
            // console.warn(settings);

            var button_desc = $('.event_info_type button.desc');
            var button_url = $('.event_info_type button.url');


            button_desc.click(function(){
                button_desc.addClass('btn-primary');
                $('.event_description').show();
                $('.event_url').hide();
                button_url.removeClass('btn-primary');
            });

            button_url.click(function(){
                button_url.addClass('btn-primary');
                $('.event_url').show();
                $('.event_description').hide();
                button_desc.removeClass('btn-primary');
            });

            var calendarID = 0;


            $("#dsEventCalendar").fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: "month,agendaWeek"
                },
                slotDuration: "00:30:00",
                defaultTimedEventDuration: "00:30:00",
                timeFormat: "HH:mm",
                eventClick: function(calEvent, jsEvent, view) {
                    if(calEvent.url != "")
                        return;

                   console.log(calEvent);
//                    console.log(jsEvent);
//                    console.log(view);

                    var start_day = calEvent.start.format(settings.formatEvent);
                    var end_day = "";
                    if(calEvent.end != null)
                        end_day = " - " + calEvent.end.format(settings.formatEvent);



                    modal.find('.header .title').text(calEvent.title);
                    modal.find('.content .time').text(start_day + end_day);
                    // modal.find('.content .description').text(calEvent.description);

                    modal.find('input#event_title').val(calEvent.title);

                    modal.find('input#event_date').val(calEvent.date);
                    modal.find('textarea#event_description').val(calEvent.description);
                    modal.find('input#event_url').val(calEvent.url);

                    var select_event_type = $("select#event_type option");

                    if(calEvent.typeID != null)
                    {
                    select_event_type.filter(function() {
                        //may want to use $.trim in here
                        return $(this).val() == calEvent.typeID;
                    }).attr('selected', true);

                    }
                    else
                    {
                        select_event_type.first().attr('selected', true);
                    }

                    calendarID = calEvent.calendarID;


//                    console.warn(calEvent.typeID);


                    //to think
                    // modal.find('.container').css("background-color",calEvent.color);


                    // color: "#0033ff"
                    // date: "2014-12-31 09:15:28"
                    // description: "aaaaa"
                    // end: null
                    // eventID: "5"
                    // id: "5"
                    // source: Object
                    // start: j
                    // title: "aaaaa"
                    // type: "Blu"
                    // url: ""


                    modal.addClass('active');

                },
                editable: true,
                eventDragStart: function (event, jsEvent, ui, view) {
                    console.log("eventDragStart");

                },
                eventDragStop: function(event,jsEvent) {
                    console.log("eventDragStop");
                },
                eventLimit: parseInt(settings.eventsInDay)+1,
                events: events,
                lang: settings.lang,
                firstDay: settings.startFrom
            });

            $("#dsEventModal .btn-close").on('click',function(){
                $(this).closest(".ds-event-modal").removeClass('active');
            });

            $("#dsEventModal .btn-update").click(function(){
                console.log("UPDATE!");



                var event_data = {
                    calendarID: calendarID,
                    eventTitle: $("#event_title").val(),
                    eventDate: $("#event_date").val(),
                    eventType: $("#event_type").val(),
                    eventDescription: $("#event_description").val(),
                    eventURL: $("#event_url").val()
                };

                $.ajax({
                    type: "post",
                    url: '<?php echo $this->action("updateEvent");?>',
                    data: event_data,
                    success: function(data){
                        console.log(data);
                    },
                    error: function(){
                        console.warn("error");
                    }
                });

            });

        });
    </script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>
