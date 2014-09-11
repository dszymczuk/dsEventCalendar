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
 		$db = Loader::db();
        if (!empty($_POST)) {

            $isSomeValueEmpty = false;
            foreach ($_POST as $key => $value) {
                if ($value === "") {
                    $isSomeValueEmpty = true;
                }
            }

            if (!$isSomeValueEmpty) {




            	//I know is not optimally but universally to new settings

	            $sql = "UPDATE dsEventCalendarSettings SET opt = ? WHERE opt= 'lang'";
                $args = array($this->post('lang'));
                $db->Execute($sql, $args);

                $sql = "UPDATE dsEventCalendarSettings SET opt = ? WHERE opt= 'formatTitle'";
                $args = array($this->post('title_format'));
                $db->Execute($sql, $args);

                $sql = "UPDATE dsEventCalendarSettings SET opt = ? WHERE opt= 'formatEvent'";
                $args = array($this->post('event_format'));
                $db->Execute($sql, $args);

                $sql = "UPDATE dsEventCalendarSettings SET opt = ? WHERE opt= 'startFrom'";
                $args = array($this->post('start_day'));
                $db->Execute($sql, $args);

                $sql = "UPDATE dsEventCalendarSettings SET opt = ? WHERE opt= 'eventsInDay'";
                $args = array($this->post('events_in_day'));
                $db->Execute($sql, $args);

                $sql = "UPDATE dsEventCalendarSettings SET opt = ? WHERE opt= 'default_name'";
                $args = array($this->post('default_name'));
                $db->Execute($sql, $args);

                $sql = "UPDATE dsEventCalendarSettings SET opt = ? WHERE opt= 'default_color'";
                $args = array($this->post('default_color'));
                $db->Execute($sql, $args);

	            $this->set('success', t('Settings have been updated.'));
                unset($_POST);
            } else {
                $this->set('error', t('Error while adding. Maybe some values were empty?'));
            }
        }

			$lang_list = array("af","ar-ma","ar-sa","ar","az","be","bg","bn","bo","br","bs","ca","cs","cv","cy","da","de-at","de","el","en-au","en-ca","en-gb","eo","es","et","eu","fa","fi","fo","fr-ca","fr","gl","he","hi","hr","hu","hy-am","id","is","it","ja","ka","km","ko","lb","lt","lv","mk","ml","mr","ms-my","my","nb","ne","nl","nn","pl","pt-br","pt","ro","ru","sk","sl","sq","sr-cyrl","sr","sv","ta","th","tl-ph","tr","tzm-latn","tzm","uk","uz","vi","zh-cn","zh-tw");
			$this->set('lang_list',$lang_list);

			$days = array(t('Monday'),t('Tuesday'),t('Wednesday'),t('Thursday'),t('Friday'),t('Saturday'),t('Sunday'));

			$this->set('days',$days);

			//default values
			$this->set('lang','en-gb');
			$this->set('formatTitle','MMMM YYYY');
			$this->set('formatEvent','DD MMMM YYYY');
			$this->set('startFrom',1); //0 - Sunday, 1 - Monday etc.
			$this->set('eventsInDay',3);
			$this->set('default_color','#808080');
			$this->set('default_name',t('Default'));
			$this->set('texts',array(
				'closeText' => t('close'),
				'typeText' => t('Type:'),
				));
    }

}