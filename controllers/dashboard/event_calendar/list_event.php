<?php  defined('C5_EXECUTE') or die("Access Denied.");


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

        $this->set('types', $dsEventCalendar->getEventTypes());

        $this->set('calendarID',$calendar_id);

    }

    public function action_test(){
//        die("action update!");
        exit;
    }

    public function getEvents(){
        Loader::library('dsEventCalendar','dsEventCalendar');

        $calendar_id = $this->get('calendarid');
        $dsEventCalendar = new dsEventCalendar();
        $json_events = $dsEventCalendar->getEventsFromCalendar($calendar_id);
        die($json_events);
//        $this->set('events', $json_events);
    }

    public function updateEvent(){
        if(isset($_POST) && !empty($_POST))
        {
            //if calendarID === 0 -> is bad !!
            if($_POST['calendarID'] == 0)
                die("ERROR");

//            $calendarID = $_POST['calendarID'];
//            $eventID = $_POST['eventID'];

            $calendarID = $this->post('calendarID');
            $eventID = $this->post('eventID');


            $sql = "UPDATE dsEventCalendarEvents SET
                calendarID = ?,
                title = ?,
                date = ?,
                type = ?,
                description = ?,
                url = ?
                WHERE eventID=" . $eventID. " and calendarID = " .$calendarID;

//            die($sql);

            $args = array(
                $this->post('calendarID'),
                $this->post('eventTitle'),
                $this->post('eventDate'),
                $this->post('eventType'),
                $this->post('eventDescription'),
                $this->post('eventURL')
            );

            $db = Loader::db();
//
            if($db->Execute($sql, $args))
                die("OK");





            die("ERROR");


//            ''  =>'1'
//            'eventID'  =>'2'
//  ''  =>'aaaaa'
//  ''  =>'2015-01-22 00:15:45'>
//        ''  =>'1'
//  ''  =>'aaaaaaaaaaa'
//  ''  =>''


//            die(var_dump($_POST));
//            die("post!");
        }
        die("ERROR");
    }

    public function myAction() {
        $values = array();
        $values[] = array('name'=>'some name 1','value'=>'some value 1');
        $values[] = array('name'=>'some name 2','value'=>'some value 2');
        $values[] = array('name'=>'some name 3','value'=>'some value 3');
        echo json_encode($values);
        exit;
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