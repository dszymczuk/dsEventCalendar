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
        /*$db = Loader::db();

        if (!empty($_POST)){
            die(var_dump($_POST));
            $isSomeValueEmpty = false;
            foreach ($_POST as $key => $value) {
                if ($value === "") {
                    $isSomeValueEmpty = true;
                }
            }

            if (!$isSomeValueEmpty) {


                $sql = "INSERT INTO dsEventCalendarTypes (type,color) VALUES (?,?)";

                $args = array(
                    $this->post('type'),
                    $this->post('color')
                );
                $db->Execute($sql, $args);

                $this->set('type', "");
                $this->set('color', "");
                $this->set('success', t('Event: ' . $this->post('type') . ' has been added'));
                unset($_POST);
            } else {
                $this->set('error', t('Error while adding. Maybe some values were empty?'));
            }
        }*/


        /*$types = $db->GetAll("SELECT * FROM `dsEventCalendarTypes`");
        $this->set('types', $types);*/

        $type = "asdasd";
        $this->set('type',$type);
        $this->set('color','');
    }

    /*public function delete()
    {
        if (isset($_POST) && is_numeric($_POST['id'])) {
            $db = Loader::db();
            $sql = "DELETE FROM dsEventCalendarEvents WHERE eventID = " . $_POST['id'];
            $db->Execute($sql);
            die("OK");
        } else {
            die("ERROR");
        }
    }*/
}