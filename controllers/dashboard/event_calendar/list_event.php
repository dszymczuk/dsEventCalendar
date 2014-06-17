<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarListEventController extends Controller {

	public function on_before_render() {
//		$this->addHeaderItem(Loader::helper('html')->css('dashboard/dsEventCalendar.css','dsEventCalendar'));
//		$this->addHeaderItem(Loader::helper('html')->javascript('dashboard/dsEventCalendar.css','dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('jquery.dataTables.min.css','dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.js','dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.dataTables.min.js','dsEventCalendar'));
	}
	
	public function view() {
        $db = Loader::db();
        $events = $db->GetAll("SELECT EC.title AS title_cal, ECE . * FROM dsEventCalendarEvents AS ECE LEFT JOIN dsEventCalendar AS EC ON ECE.calendarID = EC.calendarID");
        $this->set('events',$events);
    }

    public function delete()
    {
        if(isset($_POST) && is_numeric($_POST['id']))
        {
            $db = Loader::db();
            $sql = "DELETE FROM dsEventCalendarEvents WHERE eventID = ".$_POST['id'];
            $db->Execute($sql);
            die("OK");
        }
        else
        {
            die("ERROR");
        }
    }
}