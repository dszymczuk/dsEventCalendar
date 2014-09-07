<?php

defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventTypesController extends Controller
{

	public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('colorpicker.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('colorpicker.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('jquery.dataTables.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.dataTables.min.js', 'dsEventCalendar'));
    }

    public function view()
    {


        $this->set('type_of_event','');
        $this->set('color','');
    }

}