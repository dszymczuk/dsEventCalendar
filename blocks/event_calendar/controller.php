<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

class EventCalendarBlockController extends BlockController
{

    protected $btName = "Event Calendar";
    protected $btDescription = "";
    public $btTable = 'btEventCalendar';
    public $btInterfaceWidth = '400';
    public $btInterfaceHeight = '200';
    protected $btWrapperClass = 'ccm-ui';

    public function getBlockTypeDescription()
    {
        return $this->btDescription;
    }

    public function getBlockTypeName()
    {
        return t("Event Calendar");
    }

    public function __construct($b = null)
    {
        parent::__construct($b);
    }

    public function on_page_view()
    {

        $db = Loader::db();
        $calendar = $db->GetAll("SELECT * FROM dsEventCalendar WHERE calendarID=" . $this->calendarID);
        $this->set('calendar', $calendar);

        $json_events = $this->getEventsForCalendar($this->calendarID);
        $this->set('events', $json_events);
        $this->set('lang',$this->translateProvider());
    }

    function save($data)
    {
        $args['calendarID'] = isset($data['calendarID']) ? intval($data['calendarID']) : 0;
        parent::save($args);
    }

    function add()
    {
        $db = Loader::db();
        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars', $calendars);
    }

    function edit()
    {
        $db = Loader::db();
        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars', $calendars);
        $this->set('calendarID', $this->calendarID);
    }


    private function getEventsForCalendar($calendarID)
    {
        $db = Loader::db();
        $events = $db->GetAll("SELECT * FROM dsEventCalendarEvents WHERE calendarID = " . $calendarID);
        $js = Loader::helper('json');
        return $js->encode($events);
    }

    private function translateProvider()
    {
        $months = array(t('January'),t('February'),t('March'),t('April'),t('May'),t('June'),t('July'),t('August'),t('September'),t('October'),t('November'),t('December'));
        $days = array(t('Sunday'),t('Monday'),t('Tuesday'),t('Wednesday'),t('Thursday'),t('Friday'),t('Saturday'));
        $days_short = array(t('Sun'),t('Mon'),t('Tue'),t('Wed'), t('Thu'),t('Fri'),t('Sat'));
        $another_texts = array(
            'txt_noEvents' => t("There are no events in this period"),
            'txt_SpecificEvents_prev' => t(""),
            'txt_SpecificEvents_after' => t("events:"),
            'txt_next' => t("next"),
            'txt_prev' => t("prev"),
            'txt_NextEvents' => t("Next events:"),
            'txt_GoToEventUrl' => t("See the event"),
            'txt_LoadingText' => t("loading...")
        );
        $lang = array($months,$days,$days_short,$another_texts);
        $js = Loader::helper('json');
        return $js->encode($lang);



    }

}

?>
