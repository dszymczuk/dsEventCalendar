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
    private  $lang_list = array("ar-ma","ar-sa","ar","bg","ca","cs","da","de-at","de","el","en-au","en-ca","en-gb","es","fa","fi","fr-ca","fr","he","hi","hr","hu","id","is","it","ja","ko","lt","lv","nl","pl","pt-br","pt","ro","ru","sk","sl","sr-cyrl","sr","sv","th","tr","uk","vi","zh-cn","zh-tw");

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

        Loader::library('dsEventCalendar','dsEventCalendar');
        $dsEventCalendar = new dsEventCalendar();

        $json_events = $dsEventCalendar->getEventsFromCalendar($this->calendarID,$this->typeID);
        

        $this->set('events', $json_events);
        $this->set('settings',$dsEventCalendar->settingsProvider());

        $this->set('typeID',$this->typeID);


        if(method_exists($this->getBlockObject(),'getProxyBlock'))
        {
            $this->set(
                'blockIdentifier',
                $this->getBlockObject()->getProxyBlock()
                    ? $this->getBlockObject()->getProxyBlock()->getInstance()->getIdentifier()
                    : $this->getIdentifier()
            );
        }
        else
        {
            $this->set('blockIdentifier',rand(12,512));
        }

    }

    function save($data)
    {
        $args['calendarID'] = isset($data['calendarID']) ? intval($data['calendarID']) : 0;
        $args['typeID'] = isset($data['typeID']) ? intval($data['typeID']) : 0;
        $args['lang'] = isset($data['lang']) ? $data['lang'] : 'en-gb';
        parent::save($args);
    }

    function add()
    {
        $db = Loader::db();
        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars', $calendars);

        $this->set('langs', $this->lang_list);

        Loader::library('dsEventCalendar','dsEventCalendar');
        $dsEventCalendar = new dsEventCalendar();
        $types = $dsEventCalendar->getEventTypesForBlock();
        $this->set('types',$types);
        $this->set('types',$types);
    }

    function edit()
    {
        $db = Loader::db();
        $calendars = $db->GetAll("SELECT * FROM dsEventCalendar");
        $this->set('calendars', $calendars);
        $this->set('calendarID', $this->calendarID);

        $this->set('langs', $this->lang_list);
        $this->set('lang',$this->lang);

        Loader::library('dsEventCalendar','dsEventCalendar');
        $dsEventCalendar = new dsEventCalendar();
        $types = $dsEventCalendar->getEventTypesForBlock();
        $this->set('types',$types);
        $this->set('typeID',$this->typeID);
    }


//    private function getEventsFromCalendar($calendarID)
//    {
//        $db = Loader::db();
//
//        $q  = "SELECT ECE.eventID as id, ECE.*, ECT.* FROM dsEventCalendarEvents as ECE ";
//        $q  .= " LEFT JOIN dsEventCalendarTypes as ECT on ECE.type = ECT.typeID ";
//        $q  .= " WHERE calendarID =" . $calendarID;
//
//        $settings = $db->GetAll("SELECT * FROM dsEventCalendarSettings");
//        foreach ($settings as $s) {
//            $s['opt'] = $s['opt']."_dsECS";
//            $$s['opt'] = $s['value'];
//        }
//
//        $events = $db->GetAll($q);
//
//        foreach ($events as &$e) {
//            unset($e['eventID']);
//            unset($e['calendarID']);
//            unset($e['typeID']);
//            if($e['color'] == NULL)
//            {
//                $e['color'] = $default_color_dsECS;
//                $e['type_name'] = $default_name_dsECS;
//            }
//            $e['start'] = $e['date'];
//        }
//
//        $js = Loader::helper('json');
//        return $js->encode($events);
//    }

//    public function settingsProvider()
//    {
//        $db = Loader::db();
//        $settings = $db->GetAll("SELECT * FROM dsEventCalendarSettings");
//        $set_return = array();
//
//        foreach ($settings as $s) {
//            array_push($set_return, array(
//                $s['opt'] => $s['value']
//            ));
//        }
//
//        array_push($set_return,array('closeText' => t('close')));
//        array_push($set_return,array('typeText' => t('Type:')));
//
//        $js = Loader::helper('json');
//        return $js->encode($set_return);
//    }

}

?>
