<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
    $c = Page::getCurrentPage();
    $rand = rand(1000,2000);
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

    <div id="eventCalendarInline<?php echo $rand; ?>" class="blueEventCalendar"></div>



<?php if(!$c->isEditMode()): ?>
    <script>
        $(document).ready(function () {
            var eventsInline = {};
            eventsInline = <?php echo $events; ?>;
            var texts = {};
            texts = <?php echo $lang; ?>;
            var options = texts[3];

            $("#eventCalendarInline<?php echo $rand; ?>").eventCalendar({
                jsonData: eventsInline,
                jsonDateFormat: 'human',
                showDescription: true,
                monthNames: texts[0],
                dayNames: texts[1],
                dayNamesShort: texts[2],
                txt_noEvents: options.txt_noEvents,
                txt_SpecificEvents_prev: options.txt_SpecificEvents_prev,
                txt_SpecificEvents_after: options.txt_SpecificEvents_after,
                txt_next: options.txt_next,
                txt_prev: options.txt_prev,
                txt_NextEvents: options.txt_NextEvents,
                txt_GoToEventUrl: options.txt_GoToEventUrl,
                txt_LoadingText: options.txt_LoadingText
            });
        });
    </script>
<?php endif ?>