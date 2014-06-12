<?php       
defined('C5_EXECUTE') or die(_("Access Denied."));

    $c = Page::getCurrentPage();
	$cID = $c->getCollectionID();

    $rand = rand(1000,2000);

?>
<div id="eventTest">
    view: <?php echo $calendarID; ?>
    view: <?php var_dump($events); ?>
</div>




<div id="eventCalendarInline<?php echo $rand; ?>"></div>
<script>
    $(document).ready(function() {
        var eventsInline= <?php echo $events; ?> ;

        $("#eventCalendarInline<?php echo $rand; ?>").eventCalendar({
            jsonData: eventsInline,
            jsonDateFormat: 'human'
        });
    });
</script>