<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarEventController extends Controller
{

    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('jquery.datetimepicker.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.datetimepicker.min.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('dsStyle.css', 'dsEventCalendar'));
    }

    public function view()
    {
        $db = Loader::db();
        if (!empty($_POST)) {

            $isSomeValueEmpty = false;
            $isAllDay = 1;

            $validateArray = $_POST;
            unset($validateArray['event_url']);
            unset($validateArray['event_description']);
            unset($validateArray['event_time']);
            foreach($validateArray as $vA)
            {
                if($vA === "")
                {
                    $isSomeValueEmpty = true;
                    break;
                }
            }


            if (!$isSomeValueEmpty) {
                if($this->post('event_time') !== '')
                {
                    $isAllDay = 0;
                    $_POST['event_date'] = $_POST['event_date']." ".$_POST['event_time'];
                }

                $sql = "INSERT INTO dsEventCalendarEvents (calendarID,title,date,type,description,url,allDayEvent) VALUES (?,?,?,?,?,?,?)";

                $args = array(
                    $this->post('event_calendarID'),
                    $this->post('event_title'),
                    $this->post('event_date'),
                    $this->post('event_type'),
                    $this->post('event_description'),
                    $this->post('event_url'),
                    $isAllDay
                );

                $db->Execute($sql, $args);

                $this->set('event_title', "");
                $this->set('event_date', "");
                $this->set('event_time', "");
                $this->set('event_type', "");
                $this->set('event_description', "");
                $this->set('event_url', "");
                $this->set('success', t('Event: ' . $this->post('event_title') . ' has been added'));
                unset($_POST);
            } else {
                $this->set('event_title', $this->post('event_title'));
                $this->set('event_date', $this->post('event_date'));
                $this->set('event_time', $this->post('event_time'));
                $this->set('event_type', $this->post('event_type'));
                $this->set('event_description', $this->post('event_description'));
                $this->set('event_url', $this->post('event_url'));
                $this->set('error', t('Error while adding. Maybe some values were empty?'));
            }
        }

        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars', $calendars);

        $types = $db->GetAll("SELECT * FROM dsEventCalendarTypes");

        $settings = $db->GetAll("SELECT * FROM dsEventCalendarSettings");
        // ADD DEFAULT VALUE
        foreach ($settings as $s) {
            $s['opt'] = $s['opt']."_dsECS";
            $$s['opt'] = $s['value'];
        }

        array_unshift($types, array(
                'typeID' => 0,
                'type' => $default_name_dsECS,
                'color' => $default_color_dsECS,
            ));
        // END OF ADD DEFAULT VALUE

        $this->set('types', $types);



        $this->set('button', array(
            'class' => 'btn btn-success',
            'label' => t('Add event')
        ));

    }

}