<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$c = Page::getCurrentPage();
?>

<?php if ($c->isEditMode()): ?>
    <?php if ($calendar[0]['title'] === null): ?>
        <div class="eventCalendarInfo">
            <?php echo t('No calendar choose') ?>
        </div>
    <?php else: ?>
        <div class="eventCalendarInfo">
            <?php echo t('Edit mode for calendar:') ?> <?php echo $calendar[0]['title'] ?>
        </div>
    <?php endif; ?>

<?php endif ?>

    <div id="dsEventCalendar<?php echo $blockIdentifier; ?>">
        <!--[if lte IE 9]>
        <div class="ds-event-modal ie8 ie9" id="dsEventModal<?php echo $blockIdentifier; ?>"><![endif]-->
        <!--[if !IE]><!-->
        <div class="ds-event-modal" id="dsEventModal<?php echo $blockIdentifier; ?>"><!--<![endif]-->

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

<?php if (!$c->isEditMode()): ?>
    <script>
        $(document).ready(function () {

            var events = <?php echo $events; ?>;
            var settings = {};
            var set_serv = <?php echo $settings; ?>;

            if (!Object.keys) {
                Object.keys = function(obj) {
                    var keys = [];

                    for (var i in obj) {
                        if (obj.hasOwnProperty(i)) {
                            keys.push(i);
                        }
                    }

                    return keys;
                };
            }

            for(var key in set_serv) {
                var value = set_serv[key];
                var k = Object.keys(value);
                var v = value[k];
                settings[k] = v;
            }


            var modal = $("#dsEventModal<?php echo $blockIdentifier; ?>");

            $("#dsEventCalendar<?php echo $blockIdentifier; ?>").fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: "month,agendaDay,agendaWeek"
                },
                slotDuration: "00:30:00",
                defaultTimedEventDuration: "00:30:00",
                timeFormat: settings.timeFormat,
                eventClick: function(calEvent, jsEvent, view) {
                    if(calEvent.url)
                        return;

                    var start_day;
                    var end_day;

                    if(calEvent.allDayEvent == '0')
                    {
                        //with time
                        start_day = calEvent.start.format(settings.timeFormat);
                        end_day = "";
                        if(calEvent.end != null)
                        {
                            end_day = " - " + calEvent.end.format(settings.timeFormat);
                            end_day += " " + calEvent.end.format(settings.formatEvent);
                        }
                    }
                    else
                    {
                        //witout time
                        start_day = calEvent.start.format(settings.formatEvent);
                        end_day = "";
                        if(calEvent.end != null)
                        {
                            end_day = " - " + calEvent.end.format(settings.formatEvent);
                        }
                    }

                    modal.find('.header .title').text(calEvent.title);
                    modal.find('.content .time').text(start_day + end_day);
                    modal.find('.content .description').text(calEvent.description);
                    modal.addClass('active');

                },
                eventLimit: parseInt(settings.eventsInDay)+1,
                events: events,
                lang: '<?php echo $lang; ?>',
                firstDay: settings.startFrom
            });

            $(".ds-event-modal .btn-close").on('click',function(){
                $(this).closest(".ds-event-modal").removeClass('active');
            });
        });
    </script>
<?php endif ?>