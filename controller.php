<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

/*
 *
 * Event Calndera use this scrit for view:
 * http://www.vissit.com/jquery-event-calendar-plugin-english-version
 *
 */

class dsEventCalendarPackage extends Package
{


    protected $pkgHandle = 'dsEventCalendar';
    protected $appVersionRequired = '5.3.0';
    protected $pkgVersion = '0.1.2';

    public function getPackageDescription()
    {
        return t('Event Calendar - you can add, edit and remove one day events on your page');
    }

    public function getPackageName()
    {
        return t('dsEventCalendar');
    }

    public function install()
    {
        $pkg = parent::install();
        BlockType::installBlockTypeFromPackage('event_calendar', $pkg);
        $this->installSP($this);
    }

    public function upgrade()
    {
        $currentVersion = $this->getPackageVersion();
        parent::upgrade();
        $this->installSP($this, $currentVersion);
    }


    private function installSP($pkg)
    {
        Loader::model('single_page');

        $p1 = SinglePage::add('/dashboard/event_calendar', $pkg);
        if (is_object($p1)) {
            $p1->update(array('cName' => t('Event Calendar'), 'cDescription' => t('')));
        }

        $p2 = SinglePage::add('/dashboard/event_calendar/list_calendar', $pkg);
        if (is_object($p2)) {
            $p2->update(array('cName' => t('Calendars list'), 'cDescription' => ''));
        }

        $p3 = SinglePage::add('/dashboard/event_calendar/calendar', $pkg);
        if (is_object($p3)) {
            $p3->update(array('cName' => t('Add calendar'), 'cDescription' => ''));
        }

        $p4 = SinglePage::add('/dashboard/event_calendar/list_event', $pkg);
        if (is_object($p4)) {
            $p4->update(array('cName' => t('Events list'), 'cDescription' => ''));
        }

        $p5 = SinglePage::add('/dashboard/event_calendar/event', $pkg);
        if (is_object($p5)) {
            $p5->update(array('cName' => t('Add event'), 'cDescription' => ''));
        }
    }
}

?>