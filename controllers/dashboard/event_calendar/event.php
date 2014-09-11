<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarEventController extends Controller
{

    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('jquery.datetimepicker.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.datetimepicker.js', 'dsEventCalendar'));
    }

    public function view()
    {
        $db = Loader::db();
        if (!empty($_POST)) {

            $isSomeValueEmpty = false;
            foreach ($_POST as $key => $value) {
                if ($value === "" && $key !== 'event_url') {
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

                $this->set('event_title', "");
                $this->set('event_date', "");
                $this->set('event_type', "");
                $this->set('event_description', "");
                $this->set('event_url', "");
                $this->set('success', t('Event: ' . $this->post('event_title') . ' has been added'));
                unset($_POST);
            } else {
                $this->set('event_title', $this->post('event_title'));
                $this->set('event_date', $this->post('event_date'));
                $this->set('event_type', $this->post('event_type'));
                $this->set('event_description', $this->post('event_description'));
                $this->set('event_url', $this->post('event_url'));
                $this->set('error', t('Error while adding. Maybe some values were empty?'));
            }
        }

        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars', $calendars);

        $types = $db->GetAll("SELECT * FROM dsEventCalendarTypes");
        $this->set('types', $types);

        $this->set('button', array(
            'class' => 'btn btn-success',
            'label' => t('Add event')
        ));

    }

    public function update($event_id)
    {
        $db = Loader::db();

        if (!empty($_POST)) {

            $isSomeValueEmpty = false;
            foreach ($_POST as $key => $value) {
                if ($value === "" && $key !== 'event_url') {
                    $isSomeValueEmpty = true;
                }
            }

            if (!$isSomeValueEmpty) {
                $sql = "UPDATE dsEventCalendarEvents SET
                calendarID = ?,
                title = ?,
                date = ?,
                type = ?,
                description = ?,
                url = ?
                WHERE eventID=" . $event_id;

                $args = array(
                    $this->post('event_calendarID'),
                    $this->post('event_title'),
                    $this->post('event_date'),
                    $this->post('event_type'),
                    $this->post('event_description'),
                    $this->post('event_url')
                );
                $db->Execute($sql, $args);

                $this->set('event_title', "");
                $this->set('event_date', "");
                $this->set('event_type', "");
                $this->set('event_description', "");
                $this->set('event_url', "");
                $this->set('success', t('Event: ' . $this->post('event_title') . ' has been edited'));
                unset($_POST);
            } else {
                $this->set('error', t('Error while editing. Maybe some values were empty?'));
            }
        }

        // REFRESH FOR NEW DATA
        $sql = "SELECT * FROM dsEventCalendarEvents WHERE eventID=" . $event_id;
        $event = $db->GetRow($sql);
        $this->set('event_calendarID', $event['calendarID']);
        $this->set('event_title', $event['title']);
        $this->set('event_date', $event['date']);
        $this->set('event_type', $event['type']);
        $this->set('event_description', $event['description']);
        $this->set('event_url', $event['url']);

        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars', $calendars);

        $this->set('event_ID', $event_id);
        $this->set('button', array(
            'class' => 'btn btn-warning',
            'label' => t('Edit event')
        ));
    }
}