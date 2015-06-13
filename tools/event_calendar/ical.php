<?php
defined('C5_EXECUTE') or die("Access Denied.");

function se($s) {return preg_replace(array ('/"/','/,/','/\n/','/\r/','/:/','/;/','/\\//'), array ('\"','\\,','\\n','','\:','\\;','\\\\'), $s);}


$timeZone = "Europe/Warsaw";

if (date_default_timezone_get()) {
    $timeZone =  date_default_timezone_get();
}

if (ini_get('date.timezone')) {
    $timeZone = ini_get('date.timezone');
}

date_default_timezone_set($timeZone);

// the header directive tells the web server to tell your browser that this is a calendar file and not a regular web page
header('Content-type: text/calendar; charset=utf-8');

$db = Loader::db();
$calid = htmlspecialchars($_GET["id"]);
$cal = $db->GetAll("select * from dsEventCalendar where calendarID = '".$calid."'");
$caltitle = $cal[0]['title'];

$events = $db->GetAll("select * from dsEventCalendarEvents where calendarID = '".$calid."'");

echo "BEGIN:VCALENDAR";
echo "\nVERSION:2.0";
echo "\nMETHOD:PUBLISH";
echo "\nX-WR-CALNAME;VALUE=TEXT:".$caltitle;
echo "\nPRODID:-//".Config::get("SITE", $getFullObject=false)."//".$caltitle."//".Config::get("SITE_LOCALE", $getFullObject=false);

foreach ( $events as $e){
    echo "\nBEGIN:VEVENT";
    echo "\nMETHOD:PUBLISH";
    $Date = new DateTime( $e["date"] );
    echo "\nDTSTART;TZID=".$timezone.":" . $Date->format( 'Ymd\THis' );
    $Date = new DateTime( $e["end"] );
    echo "\nDTEND;TZID=".$timezone.":" . $Date->format( 'Ymd\THis' );
    echo "\nSUMMARY:".se($e["title"]);
    echo "\nUID:".$e["eventID"];
    //echo "\nSEQUENCE:0";
    echo "\nDESCRIPTION:".se($e["description"]);
    //echo "\nDURATION:PT3H0M";
    echo "\nCLASS:PUBLIC";
    echo "\nSTATUS:CONFIRMED";
    echo "\nEND:VEVENT";
}

echo "\nEND:VCALENDAR";
?>
