<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarListEventController extends Controller
{

    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('jquery.dataTables.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.dataTables.min.js', 'dsEventCalendar'));
    }

    public function view()
    {
        $db = Loader::db();
        
        $sql = "SELECT EC.title AS title_cal, IFNULL(ECT.type,'default') as type_name ,ECE . * FROM dsEventCalendarEvents AS ECE ";
        $sql .= " LEFT JOIN dsEventCalendar AS EC ON ECE.calendarID = EC.calendarID ";
        $sql .= " LEFT JOIN dsEventCalendarTypes AS ECT ON ECT.typeID = ECE.type ";

        $events = $db->GetAll($sql);

        $this->set('events', $events);
    }

    public function delete()
    {
        if (isset($_POST) && is_numeric($_POST['id'])) {
            $db = Loader::db();
            $sql = "DELETE FROM dsEventCalendarEvents WHERE eventID = " . $_POST['id'];
            $db->Execute($sql);
            die("OK");
        } else {
            die("ERROR");
        }
    }
}