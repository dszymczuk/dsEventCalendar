<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

class dsEventCalendarPackage extends Package
{


    protected $pkgHandle = 'dsEventCalendar';
    protected $appVersionRequired = '5.5.0';
    protected $pkgVersion = '3.3.4';

    public function getPackageDescription()
    {
        return t('Event Calendar - you can add, edit and remove one day events on your page');
    }

    public function getPackageName()
    {
        return t('Event Calendar');
    }

    public function install()
    {
        $pkg = parent::install();
        BlockType::installBlockTypeFromPackage('event_calendar', $pkg);
        $this->installSP($pkg);
        $this->installSettings();
    }

    public function upgrade()
    {
        $currentVersion = $this->getPackageVersion();
        $majorVersion = explode(".", $currentVersion);
        $majorVersion = $majorVersion[0];
        parent::upgrade();
        if ($majorVersion == 2) {
            $this->update2to3();
        }
        $this->installSP($this, $currentVersion);
        $this->installSettings();
    }

    private function update2to3()
    {
        $p4 = SinglePage::getByPath('/dashboard/event_calendar/list_event');

        if (is_object($p4)) {
            $p4->setAttribute('exclude_nav', 1);
        }

        $db = Loader::db();
        $sql = "DELETE FROM dsEventCalendarSettings WHERE opt = 'formatTitle'";
        $db->Execute($sql);

        $sql = "DELETE FROM dsEventCalendarSettings WHERE opt = 'default_name'";
        $db->Execute($sql);
    }


    private function installSP($pkg)
    {
        Loader::model('single_page');

        $p1 = SinglePage::add('/dashboard/event_calendar', $pkg);
        if (is_object($p1)) {
            $p1->update(array('cName' => t('Event Calendar'), 'cDescription' => ''));
        }

        $p2 = SinglePage::add('/dashboard/event_calendar/list_calendar', $pkg);
        if (is_object($p2)) {
            $p2->update(array('cName' => t('Calendars list'), 'cDescription' => ''));
        }

        $p4 = SinglePage::add('/dashboard/event_calendar/list_event', $pkg);
        if (is_object($p4)) {
            $p4->update(array('cName' => t('Events list'), 'cDescription' => ''));
        }

        $p3 = SinglePage::add('/dashboard/event_calendar/calendar', $pkg);
        if (is_object($p3)) {
            $p3->update(array('cName' => t('Add / edit calendar'), 'cDescription' => ''));
        }

        $p5 = SinglePage::add('/dashboard/event_calendar/event', $pkg);
        if (is_object($p5)) {
            $p5->update(array('cName' => t('Add / edit event'), 'cDescription' => ''));
        }

        $p6 = SinglePage::add('/dashboard/event_calendar/types', $pkg);
        if (is_object($p6)) {
            $p6->update(array('cName' => t('Type of events'), 'cDescription' => ''));
        }

        $p7 = SinglePage::add('/dashboard/event_calendar/settings', $pkg);
        if (is_object($p7)) {
            $p7->update(array('cName' => t('Settings'), 'cDescription' => ''));
        }

//        $p8 = SinglePage::add('/dashboard/event_calendar/help', $pkg);
//        if (is_object($p8)) {
//            $p8->update(array('cName' => t('Help'), 'cDescription' => ''));
//        }
    }

    private function installSettings()
    {
        $db = Loader::db();

        //check is settings are duplicate

        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'lang'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'lang' , value='en-gb'";
            $db->Execute($sql);
        }

        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'lang_datepicker'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'lang_datepicker' , value='en-GB'";
            $db->Execute($sql);
        }


        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'formatEvent'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'formatEvent' , value='DD MMMM YYYY'";
            $db->Execute($sql);
        }


        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'startFrom'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'startFrom' , value='1'";
            $db->Execute($sql);
        }


        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'eventsInDay'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'eventsInDay' , value='3'";
            $db->Execute($sql);
        }


        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'default_color'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'default_color' , value='#808080'";
            $db->Execute($sql);
        }


        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'timeFormat'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'timeFormat' , value='HH:mm'";
            $db->Execute($sql);
        }

        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'scrollTime'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'scrollTime' , value='1'";
            $db->Execute($sql);
        }

        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'scrollMonth'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'scrollMonth' , value='1'";
            $db->Execute($sql);
        }

        $sql = "select count(*) as count from dsEventCalendarSettings where opt= 'scrollInput'";
        $row = $db->GetRow($sql);
        if($row['count'] == 0)
        {
            $sql = "INSERT INTO dsEventCalendarSettings SET opt= 'scrollInput' , value='1'";
            $db->Execute($sql);
        }


        //remove duplicate
        $sql = "DELETE s1 FROM dsEventCalendarSettings s1, dsEventCalendarSettings s2 WHERE s1.opt = s2.opt AND s1.settingID > s2.settingID";
        $db->Execute($sql);

    }
}

?>
