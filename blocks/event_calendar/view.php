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

    <div id="eventCalendarInline<?php echo $blockIdentifier; ?>"></div>

<?php if (!$c->isEditMode()): ?>
    <script>
        $(document).ready(function () {

            console.log(<?php echo $events; ?>);

            /*var events = [
                {
                    title: 'All Day Event',
                    start: '2014-11-01'
                },
                {
                    title: 'Long Event',
                    start: '2014-11-07',
                    end: '2014-11-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2014-11-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2014-11-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2014-11-11',
                    end: '2014-11-13',
                    dupka: "dupcyngowo"
                },
                {
                    title: 'Meeting',
                    start: '2014-11-12T10:30:00',
                    end: '2014-11-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2014-11-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2014-11-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2014-11-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2014-11-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2014-11-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2014-11-28'
                }
            ];*/


            var events = <?php echo $events; ?>;
            events.forEach(function(e){
                e.start = e.date;
            })
            console.info(events);

            $("#eventCalendarInline<?php echo $blockIdentifier; ?>").fullCalendar({
//                defaultDate: '2014-12-12',
                editable: true,
                eventClick: function(calEvent, jsEvent, view) {
                    console.log(calEvent);
                    console.log(jsEvent);
                    console.log(view);
                    $(this).css('border-color', 'red');
                },
                eventLimit: true, // allow "more" link when too many events
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