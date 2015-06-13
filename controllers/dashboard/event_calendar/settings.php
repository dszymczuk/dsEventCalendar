<?php

defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarSettingsController extends Controller
{
	public function on_before_render()
    {
        $this->addHeaderItem(Loader::helper('html')->css('colorpicker.min.css', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->javascript('colorpicker.min.js', 'dsEventCalendar'));
        $this->addHeaderItem(Loader::helper('html')->css('dsStyle.css', 'dsEventCalendar'));
    }

    public function view()
    {
 		$db = Loader::db();
        if (!empty($_POST)) {


            if (!array_key_exists('scrollTime', $_POST)) {
                $_POST['scrollTime'] = '0';
            }
            if (!array_key_exists('scrollMonth', $_POST)) {
                $_POST['scrollMonth'] = '0';
            }

            if (!array_key_exists('scrollInput', $_POST)) {
                $_POST['scrollInput'] = '0';
            }

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

			$lang_list = array("ar-ma","ar-sa","ar","bg","ca","cs","da","de-at","de","el","en-au","en-ca","en-gb","es","fa","fi","fr-ca","fr","he","hi","hr","hu","id","is","it","ja","ko","lt","lv","nl","pl","pt-br","pt","ro","ru","sk","sl","sr-cyrl","sr","sv","th","tr","uk","vi","zh-cn","zh-tw");
			$this->set('lang_list',$lang_list);

			$days = array(t('Monday'),t('Tuesday'),t('Wednesday'),t('Thursday'),t('Friday'),t('Saturday'),t('Sunday'));
			$this->set('days',$days);

            $lang_datepicker_list = array("ar","az","bg","bs","ca","ch","cs","da","de","en","en-GB","es","et","eu","fa","fi","fr","gl","he","hr","hu","id","it","ja","ko","kr","lt","lv","mk","mn","nl","no","pl","pt","pt-BR","ro","ru","se","sk","sl","sq","sr","sr-YU","sv","th","tr","uk","vi","zh","zh-TW");
            $this->set('lang_datepicker_list',$lang_datepicker_list);


            $settings = $db->GetAll("SELECT * FROM dsEventCalendarSettings");
            
            foreach ($settings as $s) {
                $this->set($s['opt'],$s['value']);
            }
    }

}