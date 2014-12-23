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

    <div id="eventCalendarInline<?php echo $blockIdentifier; ?>">
        <div class="ds-event-modal">
            <div class="container">
                asdasd
            </div>
        </div>
    </div>

<?php if (!$c->isEditMode()): ?>
    <script>
        $(document).ready(function () {

            console.log(<?php echo $events; ?>);


            var events = <?php echo $events; ?>;
            events.forEach(function(e){
                e.start = e.date;
            })
            console.info(events);

            $("#eventCalendarInline<?php echo $blockIdentifier; ?>").fullCalendar({
//                defaultDate: '2014-12-12',
                editable: true,
                timeFormat: "H:mm",
                eventClick: function(calEvent, jsEvent, view) {
                    console.log(calEvent);
                    console.log(jsEvent);
                    console.log(view);
                    $(this).css('border-color', 'red');
                },
                eventLimit: 2, // allow "more" link when too many events
                events: events
            });

            /*var eventsInline = {};
            eventsInline = <?php echo $events; ?>;
            var settings = {};
            var set_serv = <?php echo $settings; ?>;

            for(var key in set_serv) {
                var value = set_serv[key];
                var k = Object.keys(value);
                var v = value[k];
                settings[k] = v;
            }

            $("#eventCalendarInline<?php echo $blockIdentifier; ?>").JSONEventCalendar(eventsInline,{
                lang: settings.lang,
                formatTitle: settings.formatTitle,
                formatEvent: settings.formatEvent,
                startFrom: settings.startFrom,
                eventsInDay: settings.eventsInDay,
                closeText: settings.closeText,
                typeText: settings.typeText
            });*/
        });
    </script>
<?php endif ?>