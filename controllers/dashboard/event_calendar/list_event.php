<?php defined('C5_EXECUTE') or die("Access Denied.");


class DashboardEventCalendarListEventController extends Controller
{

    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('jquery.datetimepicker.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('fullcalendar.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('dsStyle.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('moment.min.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.datetimepicker.min.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('fullcalendar.min.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('lang-all.js', 'dsEventCalendar'));
    }

    public function view()
    {
        //redirect if param is not exist
        $this->redirect("dashboard/event_calendar/list_calendar");
    }

    public function show($calendar_id)
    {
        Loader::library('dsEventCalendar', 'dsEventCalendar');
        $dsEventCalendar = new dsEventCalendar();

        $json_events = $dsEventCalendar->getEventsFromCalendar($calendar_id);
        $this->set('events', $json_events);
        $this->set('settings', $dsEventCalendar->settingsProvider());
        $this->set('types', $dsEventCalendar->getEventTypes());
        $this->set('calendarID', $calendar_id);
    }

    public function getEvents()
    {
        Loader::library('dsEventCalendar', 'dsEventCalendar');

        $calendar_id = $this->get('calendarid');
        $dsEventCalendar = new dsEventCalendar();
        $json_events = $dsEventCalendar->getEventsFromCalendar($calendar_id);
        die($json_events);
    }

    public function updateEvent()
    {
        if (isset($_POST) && !empty($_POST)) {
            //if calendarID === 0 -> is bad !!
            if ($_POST['calendarID'] == 0)
                die("ERROR");

            $calendarID = $this->post('calendarID');
            $eventID = $this->post('eventID');


            $date = date_create($_POST['eventEndDate']);
            if($_POST['eventStartDate'] != $_POST['eventEndDate'])
                $date = date_add($date, date_interval_create_from_date_string('1 day'));


            $date_end = date_format($date,"Y-m-d");

            $startDate = trim($this->post('eventStartDate')." ".$this->post('eventStartTime'));
            $endDate = trim($date_end." ".$this->post('eventEndTime'));

            $startDate = new DateTime($startDate);
            $endDate = new DateTime($endDate);

            $sql = "UPDATE dsEventCalendarEvents SET
                calendarID = ?,
                title = ?,
                date = ?,
                end = ?,
                type = ?,
                description = ?,
                url = ?
                WHERE eventID=" . $eventID . " and calendarID = " . $calendarID;

            $args = array(
                $this->post('calendarID'),
                $this->post('eventTitle'),
                $startDate->format('Y-m-d H:i:s'),
                $endDate->format('Y-m-d H:i:s'),
                $this->post('eventType'),
                $this->post('eventDescription'),
                $this->post('eventURL')
            );

            $db = Loader::db();

            if ($db->Execute($sql, $args))
                die("OK");

            die("ERROR");

        }
        die("ERROR");
    }

    public function removeEvent(){
        if (isset($_POST) && !empty($_POST)) {
            $eventID = $this->post('eventID');
            if(is_numeric($eventID))
            {
                $db = Loader::db();
                $sql = "DELETE FROM dsEventCalendarEvents WHERE eventID = " . $eventID;
                if($db->Execute($sql))
                    die("OK");
                else
                    die("ERROR");
            }

            die("ERROR");
        }
    }

    public function updateDateEvent(){
        if (isset($_POST) && !empty($_POST)) {
            //if calendarID === 0 -> is bad !!
            if ($_POST['calendarID'] == 0)
                die("ERROR");

            $calendarID = $this->post('calendarID');
            $eventID = $this->post('eventID');
            $eventStart = $this->post('eventDate');
            $eventEnd = $this->post('eventEnd');

            $args = array(
                $eventStart
            );

            $sql = "UPDATE dsEventCalendarEvents SET date = ? ";

            if($eventEnd != "")
            {
                $sql .= " , end = ? ";
                array_push($args,$eventEnd);
            }

            $sql .= " WHERE eventID=" . $eventID . " and calendarID = " . $calendarID;

            $db = Loader::db();

            if ($db->Execute($sql,$args))
                die("OK");

            die("ERROR");

        }
    }

    public function updateDateEventRange(){
        if (isset($_POST) && !empty($_POST)) {
            //if calendarID === 0 -> is bad !!
            if ($_POST['calendarID'] == 0)
                die("ERROR");

            $calendarID = $this->post('calendarID');
            $eventID = $this->post('eventID');
            $eventEnd = $this->post('eventEnd');

            $args = array(
                $eventEnd
            );

            $sql = "UPDATE dsEventCalendarEvents SET end = ? ";

            $sql .= " WHERE eventID=" . $eventID . " and calendarID = " . $calendarID;

            $db = Loader::db();

            if ($db->Execute($sql,$args))
                die("OK");

            die("ERROR");

        }
    }

    public function clearEvents($calendar_id)
    {
        if (is_numeric($calendar_id)) {
            Loader::library('dsEventCalendar','dsEventCalendar');
            $dsEventCalendar = new dsEventCalendar();
            $dsEventCalendar->removeEventFromCalendar($calendar_id);
            $this->redirect("dashboard/event_calendar/list_calendar");
        }
    }
}