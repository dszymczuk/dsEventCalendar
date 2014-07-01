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
        //$this->addHeaderItem(Loader::helper('html')->css('/blocks/event_calendar/css/eventCalendar.css','dsEventCalendar'));
        //$this->addHeaderItem(Loader::helper('html')->css('/blocks/event_calendar/css/eventCalendar_theme.css','dsEventCalendar'));
        //$this->addHeaderItem(Loader::helper('html')->css('/blocks/event_calendar/css/eventCalendar_theme_responsive.css','dsEventCalendar'));

        $db = Loader::db();
        $calendar = $db->GetAll("SELECT * FROM dsEventCalendar WHERE calendarID=" . $this->calendarID);
        $this->set('calendar', $calendar);

        $json_events = $this->getEventsForCalendar($this->calendarID);
        $this->set('events', $json_events);
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

}

?>
