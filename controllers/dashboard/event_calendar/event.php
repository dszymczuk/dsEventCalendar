<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarEventController extends Controller
{

    public $helpers = array('form');

    public function on_before_render()
    {
//		$this->addHeaderItem(Loader::helper('html')->css('dashboard/multilingual.css','multilingual'));
    }

    public function view()
    {
        $db = Loader::db();
        if (!empty($_POST)) {


            $isSomeValueEmpty = false;
            foreach ($_POST as $key => $value) {
                if ($value === "") {
                    $isSomeValueEmpty = true;
                }
            }

            if (!$isSomeValueEmpty) {

                $this->post('event_title');
                $this->post('event_date');
                $this->post('event_type');
                $this->post('event_description');
                $this->post('event_url');

                $sql = "INSERT INTO dsEventCalendarEvents (calendarID,title,date,type,description,url) VALUES (?,?,?,?,?,?)";

                $args = array(
                    $this->post('event_calendarID'),
                    $this->post('event_title'),
                    $this->post('event_date'),
                    $this->post('event_type'),
                    $this->post('event_description'),
                    $this->post('event_url')
                );
                $db->Execute($sql, $args);

                /*
                 * calendarID
                    date
                    type
                    title
                    description
                    url
                 */


                $this->set('event_title', "");
                $this->set('event_date', "");
                $this->set('event_type', "");
                $this->set('event_description', "");
                $this->set('event_url', "");
                unset($_POST);
                $this->set('success', 'Event: ' . $this->post('event_title') . ' has been added');
            } else {
                $this->set('error', 'Error while adding. Maybe some values were empty?');
            }
        }


        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars',$calendars);


    }

    public function add()
    {
//        if($_POST['calendar_title'] !== "")
//        {
//            $db = Loader::db();
//
//            $args = array(
//                $this->post('calendar_title'),
//                $this->post('hours'),
//                $this->post('description'),
//                Loader::helper('form/date_time')->translate('date_conducted')
//            );
//
//            $this->redirect('/dashboard/event_calendar/list_calendar');
//        }
//        else
//        {
//            $this->redirect('/dashboard/event_calendar/calendar');
//        }
    }
}