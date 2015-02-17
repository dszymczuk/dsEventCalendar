<?php

defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarHelpController extends Controller
{

    public function view()
    {

    }

    public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('dsStyle.css', 'dsEventCalendar'));
    }

}