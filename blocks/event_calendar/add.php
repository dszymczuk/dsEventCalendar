<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$bt->inc('form_setup_html.php',
    array(
        'calendars' => $calendars,
        'langs' => $langs,
        'calendarID' => null,
        'lang' => $lang,
        'types' => $types,
        'contentHeight' => null
    ));
?>