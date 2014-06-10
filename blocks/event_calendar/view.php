<?php       
defined('C5_EXECUTE') or die(_("Access Denied."));

    $c = Page::getCurrentPage();
	$cID = $c->getCollectionID();

?>
<div id="eventTest">
    view: <?php echo $calendarID; ?>
</div>
