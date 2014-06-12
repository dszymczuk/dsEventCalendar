<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarListCalendarController extends Controller {

	public function on_before_render() {
//		$this->addHeaderItem(Loader::helper('html')->css('dashboard/dsEventCalendar.css','dsEventCalendar'));
//		$this->addHeaderItem(Loader::helper('html')->javascript('dashboard/dsEventCalendar.css','dsEventCalendar'));
	}

    public function view() {
        $db = Loader::db();
        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars',$calendars);
    }

    public function delete()
    {
        if(isset($_POST) && is_numeric($_POST['id']))
        {
            $db = Loader::db();

            $sql = "DELETE FROM dsEventCalendarEvents WHERE calendarID = ".$_POST['id'];
            $db->Execute($sql);

            $sql = "DELETE FROM dsEventCalendar WHERE calendarID = ".$_POST['id'];
            $db->Execute($sql);
            die("OK");
        }
        else
        {
            die("ERROR");
        }
    }
}