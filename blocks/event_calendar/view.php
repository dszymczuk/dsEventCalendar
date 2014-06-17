<?php       
defined('C5_EXECUTE') or die(_("Access Denied."));

    $c = Page::getCurrentPage();
	$cID = $c->getCollectionID();

    $rand = rand(1000,2000);

?>

<?php if($c->isEditMode()): ?>
    <div class="eventCalendarInfo">
        Edit mode for calendar: "<?php echo $calendar[0]['title'] ?>".
    </div>
<?php endif ?>


<div id="eventCalendarInline<?php echo $rand; ?>"></div>

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