<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

class dsEventCalendar
{

    public function getEventsFromCalendar($calendarID,$typeID = 0)
    {
        $db = Loader::db();

        $q = "SELECT ECE.eventID as id,  ";
        $q .= ' IF(ECE.allDayEvent = 1,concat(date(ECE.date),""),ECE.date) AS start_time, ';
        $q .= ' IF(ECE.allDayEvent = 1,concat(date(ECE.end),""),ECE.end) AS end_time, ';
        $q .= " ECE.*, ECT.* FROM dsEventCalendarEvents as ECE  ";
        $q .= " LEFT JOIN dsEventCalendarTypes as ECT on ECE.type = ECT.typeID  ";
        $q .= " WHERE calendarID =" . $calendarID;

        if($typeID != 0) {
            $q .= " AND typeID in(".$typeID.")" ;
        }


        $settings = $db->GetAll("SELECT * FROM dsEventCalendarSettings");
        foreach ($settings as $s) {
            $s['opt'] = $s['opt'] . "_dsECS";
            $$s['opt'] = $s['value'];
        }

        $events = $db->GetAll($q);

        foreach ($events as &$e) {
            if ($e['color'] == NULL) {
                $e['color'] = $default_color_dsECS;
                $e['type_name'] = $default_name_dsECS;
            }
            $e['start'] = $e['start_time'];
            $e['end'] = $e['end_time'];
        }

        $js = Loader::helper('json');
        return $js->encode($events);
    }

    public function settingsProvider()
    {
        $db = Loader::db();
        $settings = $db->GetAll("SELECT * FROM dsEventCalendarSettings");
        $set_return = array();

        foreach ($settings as $s) {
            array_push($set_return, array(
                $s['opt'] => $s['value']
            ));
        }

        array_push($set_return, array('closeText' => t('close')));
        array_push($set_return, array('typeText' => t('Type:')));

        $js = Loader::helper('json');
        return $js->encode($set_return);
    }

    public function getEventTypes()
    {
        $db = Loader::db();
        $types = $db->GetAll("SELECT ECT.*, count(ECE.eventID) as total_types FROM dsEventCalendarTypes AS ECT LEFT JOIN dsEventCalendarEvents AS ECE ON ECE.type = ECT.typeID group by ECT.typeID");
        return $types;
    }

    public function getEventTypesForBlock(){
        $types = $this->getEventTypes();
        array_unshift($types,array(
            'typeID' => 0,
            'type' => t('All')
        ));
        return $types;
    }

    public function removeEventFromCalendar($calendarID){
        $db = Loader::db();
        $sql = "DELETE FROM dsEventCalendarEvents WHERE calendarID = " . $calendarID;
        return $db->Execute($sql);
    }
}