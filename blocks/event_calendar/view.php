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
            var eventsInline = {};
            eventsInline = <?php echo $events; ?>;
            var settings = {};
            var set_serv = <?php echo $settings; ?>;

            for(var key in set_serv) {
                var value = set_serv[key];
                var k = Object.keys(value);
                var v = value[k];
                settings[k] = v;
            }

            console.log(eventsInline);
            //var options = settings[3];

            $("#eventCalendarInline<?php echo $blockIdentifier; ?>").JSONEventCalendar(eventsInline,{
                lang: settings.lang,
                formatTitle: settings.formatTitle,
                formatEvent: settings.formatEvent,
                startFrom: settings.startFrom,
                eventsInDay: settings.eventsInDay,
                closeText: settings.closeText,
                typeText: settings.typeText
            });
        });
    </script>
<?php endif ?>