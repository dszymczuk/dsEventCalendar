<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarEventController extends Controller {

	public $helpers = array('form');
	
	public function on_before_render() {
//		$this->addHeaderItem(Loader::helper('html')->css('dashboard/multilingual.css','multilingual'));
	}
	
	public function view() {


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