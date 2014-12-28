<?php


class dsEventCalendar {

    public function getEventsFromCalendar($calendarID)
    {
        $db = Loader::db();

        $q  = "SELECT ECE.eventID as id, ECE.*, ECT.* FROM dsEventCalendarEvents as ECE ";
        $q  .= " LEFT JOIN dsEventCalendarTypes as ECT on ECE.type = ECT.typeID ";
        $q  .= " WHERE calendarID =" . $calendarID;

        $settings = $db->GetAll("SELECT * FROM dsEventCalendarSettings");
        foreach ($settings as $s) {
            $s['opt'] = $s['opt']."_dsECS";
            $$s['opt'] = $s['value'];
        }

        $events = $db->GetAll($q);

        foreach ($events as &$e) {
            unset($e['eventID']);
            unset($e['calendarID']);
            unset($e['typeID']);
            if($e['color'] == NULL)
            {
                $e['color'] = $default_color_dsECS;
                $e['type_name'] = $default_name_dsECS;
            }
            $e['start'] = $e['date'];
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

        array_push($set_return,array('closeText' => t('close')));
        array_push($set_return,array('typeText' => t('Type:')));

        $js = Loader::helper('json');
        return $js->encode($set_return);
    }
}