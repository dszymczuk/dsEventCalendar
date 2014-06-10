<?php
defined('C5_EXECUTE') or die(_("Access Denied."));

/*
 *
 * Event Calndera use this scrit for view:
 * http://www.vissit.com/jquery-event-calendar-plugin-english-version
 *
 */
class dsEventCalendarPackage extends Package {


    protected $pkgHandle = 'dsEventCalendar';
    protected $appVersionRequired = '5.3.0';
    protected $pkgVersion = '0.1';

    public function getPackageDescription() {
        return t('Event Calendar - you can add, edit and remove one day events on your page');
    }

    public function getPackageName() {
        return t('dsEventCalendar');
    }

    public function install() {
        $pkg = parent::install();

        BlockType::installBlockTypeFromPackage('event_calendar', $pkg);
    }
}
?>