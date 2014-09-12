<?php

defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarSettingsController extends Controller
{
	public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('colorpicker.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('colorpicker.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('jquery.js', 'dsEventCalendar'));
    }

    public function view()
    {
 		$db = Loader::db();
        if (!empty($_POST)) {

            $isSomeValueEmpty = false;
            foreach ($_POST as $key => $value) {
                if ($value === "" && $key !== "default_name") {
                    $isSomeValueEmpty = true;
                }
            }

            if (!$isSomeValueEmpty) {


            	//I know is not optimally but universally to new settings
                foreach ($_POST as $key => $value) {
                    $sql = "UPDATE dsEventCalendarSettings SET value = '".$value."' WHERE opt= '".$key."'";
                    $db->Execute($sql);
                }

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

            $settings = $db->GetAll("SELECT * FROM dsEventCalendarSettings");
            
            foreach ($settings as $s) {
                $this->set($s['opt'],$s['value']);
            }

			$this->set('texts',array(
				'closeText' => t('close'),
				'typeText' => t('Type:'),
				));
    }

}