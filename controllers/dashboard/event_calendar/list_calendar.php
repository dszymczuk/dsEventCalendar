<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarListCalendarController extends Controller
{
    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('dsStyle.css', 'dsEventCalendar'));
    }

    public function view()
    {
        $db = Loader::db();
        $calendars = $db->GetAll("SELECT EC.*, count(ECE.eventID) as total_events FROM dsEventCalendar AS EC LEFT JOIN dsEventCalendarEvents AS ECE ON ECE.calendarID = EC.calendarID group by EC.calendarID");
        $this->set('calendars', $calendars);
    }

    public function delete()
    {
        if (isset($_POST) && is_numeric($_POST['id'])) {
            $db = Loader::db();

            $sql = "DELETE FROM dsEventCalendarEvents WHERE calendarID = " . $_POST['id'];
            $db->Execute($sql);

            $sql = "DELETE FROM dsEventCalendar WHERE calendarID = " . $_POST['id'];
            $db->Execute($sql);
            die("OK");
        } else {
            die("ERROR");
        }
    }
}