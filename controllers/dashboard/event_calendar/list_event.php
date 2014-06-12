<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarListEventController extends Controller {

	public function on_before_render() {
//		$this->addHeaderItem(Loader::helper('html')->css('dashboard/dsEventCalendar.css','dsEventCalendar'));
//		$this->addHeaderItem(Loader::helper('html')->javascript('dashboard/dsEventCalendar.css','dsEventCalendar'));
	}
	
	public function view() {
        $db = Loader::db();
        $events = $db->GetAll("SELECT * FROM dsEventCalendarEvents");
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