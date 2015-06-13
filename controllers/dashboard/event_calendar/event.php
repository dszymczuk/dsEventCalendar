<?php  defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarEventController extends Controller
{

    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('jquery.datetimepicker.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('dsStyle.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('moment.min.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.datetimepicker.min.js', 'dsEventCalendar'));
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
            unset($validateArray['event_start_time']);
            unset($validateArray['event_end_date']);
            unset($validateArray['event_end_time']);
            foreach($validateArray as $vA)
            {
                if($vA === "")
                {
                    $isSomeValueEmpty = true;
                    break;
                }
            }

            $this->set('event_title', $this->post('event_title'));
            $this->set('event_start_date', $this->post('event_start_date'));
            $this->set('event_start_time', $this->post('event_start_time'));
            $this->set('event_end_date', $this->post('event_end_date'));
            $this->set('event_end_time', $this->post('event_end_time'));
            $this->set('event_type', $this->post('event_type'));
            $this->set('event_description', $this->post('event_description'));
            $this->set('event_url', $this->post('event_url'));

            if (!$isSomeValueEmpty) {
                if(strtotime($this->post('event_start_date')) <= strtotime($this->post('event_end_date'))
                   or strtotime($this->post('event_start_time')) < strtotime($this->post('event_end_time')))
                {
                    $startDate = date_format(date_create($_POST['event_start_date']),"Y-m-d");
                    $startTime = $this->post('event_start_time');
                    $date = date_create($_POST['event_end_date']);
                    date_modify($date, '+1 day');
                    $date_end = date_format($date,'Y-m-d');

                    if(!empty($startTime))
                    {
                        $isAllDay = 0;
                        $date_end = $startDate." ".$_POST['event_end_time'];
                        $startDate = $startDate." ".$_POST['event_start_time'];
                    }

                    $sql = "INSERT INTO dsEventCalendarEvents (calendarID,title,date,type,description,url,end,allDayEvent) VALUES (?,?,?,?,?,?,?,?)";

                    $args = array(
                        $this->post('event_calendarID'),
                        $this->post('event_title'),
                        $startDate,
                        $this->post('event_type'),
                        $this->post('event_description'),
                        $this->post('event_url'),
                        $date_end,
                        $isAllDay
                    );


                    $db->Execute($sql, $args);

                    $this->set('event_title', "");
                    $this->set('event_start_date', "");
                    $this->set('event_start_time', "");
                    $this->set('event_end_date', "");
                    $this->set('event_end_time', "");
                    $this->set('event_type', "");
                    $this->set('event_description', "");
                    $this->set('event_url', "");
                    $this->set('success', t('Event: ' . $this->post('event_title') . ' has been added'));
                    unset($_POST);
                } else {
                    $this->set('error', t('Error while adding. Enddate or endtime is not correct.'));
                }
            } else {
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

        $this->set('lang_datepicker', $lang_datepicker_dsECS);
        $this->set('scrollTime', $scrollTime_dsECS);
        $this->set('scrollMonth', $scrollMonth_dsECS);
        $this->set('scrollInput', $scrollInput_dsECS);

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
