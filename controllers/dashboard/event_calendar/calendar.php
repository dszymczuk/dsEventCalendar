<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarCalendarController extends Controller
{

    public $helpers = array('form');

    public function on_before_render()
    {
//		$this->addHeaderItem(Loader::helper('html')->css('dashboard/multilingual.css','multilingual'));
    }

    public function view()
    {


        if (!empty($_POST)) {


            if(isset($_POST['calendar_title']) && $_POST['calendar_title'] !== "")
            {
                $db = Loader::db();
                $sql = "INSERT INTO dsEventCalendar (title) VALUES (?)";

                $args = array(
                    $this->post('calendar_title')
                );
                $db->Execute($sql, $args);
                $this->set('success','Calendar '.$this->post('calendar_title').' has been added');
                $this->set('calendar_title',"");
                unset($_POST);
            }
            else
            {
                $this->set('error','Error while adding. Maybe calendar title was empty?');
            }
        }



    }

    public function add()
    {
//        die(var_dump($_POST));
//        if($_POST['calendar_title'] !== "")
//        {
//            $db = Loader::db();
//            $sql = "INSERT INTO dsEventCalendar (title) VALUES ?";
//
//            $args = array(
//                $this->post('calendar_title')
//            );
//
//            $db->Execute($sql,$args);
//
//            $this->redirect('/dashboard/event_calendar/list_calendar');
//        }
//        else
//        {
//            $this->redirect('/dashboard/event_calendar/calendar');
//        }


    }

    public function update()
    {
        die("update");
    }
}