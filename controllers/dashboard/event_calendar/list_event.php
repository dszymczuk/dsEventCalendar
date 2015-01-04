<?php defined('C5_EXECUTE') or die("Access Denied.");


class DashboardEventCalendarListEventController extends Controller
{

    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('jquery.datetimepicker.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('fullcalendar.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('dsStyle.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('moment.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.datetimepicker.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('fullcalendar.js', 'dsEventCalendar'));
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

            $sql = "UPDATE dsEventCalendarEvents SET
                calendarID = ?,
                title = ?,
                date = ?,
                type = ?,
                description = ?,
                url = ?
                WHERE eventID=" . $eventID . " and calendarID = " . $calendarID;

            $args = array(
                $this->post('calendarID'),
                $this->post('eventTitle'),
                $this->post('eventDate'),
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
}