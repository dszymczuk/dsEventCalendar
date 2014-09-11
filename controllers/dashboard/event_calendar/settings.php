<?php

defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarSettingsController extends Controller
{
	public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('colorpicker.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('colorpicker.js', 'dsEventCalendar'));
        //$this->addHeaderItem(Loader::helper('html')->css('jquery.dataTables.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.js', 'dsEventCalendar'));
        //$this->addHeaderItem(Loader::helper('html')->javascript('jquery.dataTables.min.js', 'dsEventCalendar'));
    }

    public function view()
    {
		/*
			lang
			date format
			date format 2
			start from day
			default event name
			defautl event color
		*/


			/*
language
title_format
event_format
start_day
events_in_day
			*/

			$lang_list = array("af","ar-ma","ar-sa","ar","az","be","bg","bn","bo","br","bs","ca","cs","cv","cy","da","de-at","de","el","en-au","en-ca","en-gb","eo","es","et","eu","fa","fi","fo","fr-ca","fr","gl","he","hi","hr","hu","hy-am","id","is","it","ja","ka","km","ko","lb","lt","lv","mk","ml","mr","ms-my","my","nb","ne","nl","nn","pl","pt-br","pt","ro","ru","sk","sl","sq","sr-cyrl","sr","sv","ta","th","tl-ph","tr","tzm-latn","tzm","uk","uz","vi","zh-cn","zh-tw");
			$this->set('lang_list',$lang_list);

			$days = array(
				t('Monday'),
				t('Tuesday'),
				t('Wednesday'),
				t('Thursday'),
				t('Friday'),
				t('Saturday'),
				t('Sunday')
				);

			$this->set('days',$days);

			//default values
			$this->set('lang','en-gb');
			$this->set('formatTitle','MMMM YYYY');
			$this->set('formatEvent','DD MMMM YYYY');
			$this->set('startFrom',1); //0 - Sunday, 1 - Monday etc.
			$this->set('eventsInDay',3);
			$this->set('texts',array(
				'closeText' => t('close'),
				'typeText' => t('Type:'),
				));
    }

}