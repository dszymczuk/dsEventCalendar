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
        <div class="ds-drop-trash" id="dsEventCalendarTrash">
            Drop here to remove event
        </div>
        <div class="ds-event-modal" id="dsEventModal">
            <div class="container">
                <div class="header">
                    <div class="title"></div>
                </div>
                <div class="content">
                    <div class="time"></div>
                    <div class="description"></div>
                </div>
                <div class="footer">
                    <div class="buttons">
                        <div class="btn btn-close"><?php echo t("Close") ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {

            var dsEventCalendar = $("#dsEventCalendar");
            var modal = $("#dsEventModal");
            var trashElement = $('#dsEventCalendarTrash');

            var events = <?php echo $events; ?>;
            var settings = {};
            var set_serv = <?php echo $settings; ?>;

            for(var key in set_serv) {
                var value = set_serv[key];
                var k = Object.keys(value);
                var v = value[k];
                settings[k] = v;
            }

            console.info(events);
            console.warn(settings);

            dsEventCalendar.fullCalendar({
                header: {
                    right: "today,month,agendaDay,agendaWeek"
                },
                slotDuration: "00:30:00",
                defaultTimedEventDuration: "00:30:00",
                timeFormat: "HH:mm",
                eventClick: function(calEvent, jsEvent, view) {
                    if(calEvent.url != "")
                        return;

//                    console.log(calEvent);
//                    console.log(jsEvent);
//                    console.log(view);

                    var start_day = calEvent.start.format(settings.formatEvent);
                    var end_day = "";
                    if(calEvent.end != null)
                        end_day = " - " + calEvent.end.format(settings.formatEvent);

                    modal.find('.header .title').text(calEvent.title);
                    modal.find('.content .time').text(start_day + end_day);
                    modal.find('.content .description').text(calEvent.description);
                    modal.addClass('active');

                },
                eventDragStart: function (event, jsEvent, ui, view) {
                    trashElement.addClass('active');
                },
                eventDragRemove:function(event,jsEvent){
                    var ofs = trashElement.offset();
                    var x1 = ofs.left;
                    var x2 = ofs.left + trashElement.outerWidth(true);
                    var y1 = ofs.top;
                    var y2 = ofs.top + trashElement.outerHeight(true);

                    if (jsEvent.pageX >= x1 && jsEvent.pageX<= x2 &&
                            jsEvent.pageY>= y1 && jsEvent.pageY <= y2) {
                        dsEventCalendar.fullCalendar('removeEvents', event._id);
                        trashElement.removeClass('active');
                    }
                },
                eventDragStop: function(event,jsEvent) {
                    trashElement.removeClass('active');
                },
                eventLimit: parseInt(settings.eventsInDay)+1,
                events: events,
                lang: settings.lang,
                firstDay: settings.startFrom
            });

            $("#dsEventModal .btn-close").on('click',function(){
                $(this).closest(".ds-event-modal").removeClass('active');
            });

        });
    </script>

<?php endif; ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(); ?>
