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

    <div id="eventCalendarInline<?php echo $rand; ?>" class="redEventCalendar"></div>



<?php if(!$c->isEditMode()): ?>
<script>
    $(document).ready(function() {
        var eventsInline = {} ;
        eventsInline = <?php echo $events; ?> ;


        $("#eventCalendarInline<?php echo $rand; ?>").eventCalendar({
            jsonData: eventsInline,
            jsonDateFormat: 'human',
            showDescription: true
        });
    });
</script>
<?php endif ?>