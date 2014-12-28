<?php  defined('C5_EXECUTE') or die("Access Denied.");


class DashboardEventCalendarListEventController extends Controller
{

    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('fullcalendar.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('dsStyle.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('moment.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('fullcalendar.js', 'dsEventCalendar'));
    }

    public function view()
    {
//        $db = Loader::db();
        
//        $sql = "SELECT EC.title AS title_cal, IFNULL(ECT.type,'default') as type_name ,ECE . * FROM dsEventCalendarEvents AS ECE ";
//        $sql .= " LEFT JOIN dsEventCalendar AS EC ON ECE.calendarID = EC.calendarID ";
//        $sql .= " LEFT JOIN dsEventCalendarTypes AS ECT ON ECT.typeID = ECE.type ";
//
//        $events = $db->GetAll($sql);
//
//        $this->set('events', $events);
//        die("view");

        //redirect if param is not exist
        $this->redirect("dashboard/event_calendar/list_calendar");
    }

    public function show($calendar_id)
    {
//        die("show");

//                $db = Loader::db();

//        $sql = "SELECT EC.title AS title_cal, IFNULL(ECT.type,'default') as type_name ,ECE . * FROM dsEventCalendarEvents AS ECE ";
//        $sql .= " LEFT JOIN dsEventCalendar AS EC ON ECE.calendarID = EC.calendarID ";
//        $sql .= " LEFT JOIN dsEventCalendarTypes AS ECT ON ECT.typeID = ECE.type ";


//        $sql = "SELECT ECE.eventID as id, ECE.*, ECT.* FROM dsEventCalendarEvents as ECE ";
//        $sql .= " LEFT JOIN dsEventCalendarTypes as ECT on ECE.type = ECT.typeID ";
//        $sql .= " WHERE calendarID =" . $calendar_id;
//
//        $events = $db->GetAll($sql);



//        $this->set('events', $events);

        Loader::library('dsEventCalendar','dsEventCalendar');


        $dsEventCalendar = new dsEventCalendar();

        $json_events = $dsEventCalendar->getEventsFromCalendar($calendar_id);
        $this->set('events', $json_events);

        $this->set('settings',$dsEventCalendar->settingsProvider());

    }

//    public function delete()
//    {
//        if (isset($_POST) && is_numeric($_POST['id'])) {
//            $db = Loader::db();
//            $sql = "DELETE FROM dsEventCalendarEvents WHERE eventID = " . $_POST['id'];
//            $db->Execute($sql);
//            die("OK");
//        } else {
//            die("ERROR");
//        }
//    }
}