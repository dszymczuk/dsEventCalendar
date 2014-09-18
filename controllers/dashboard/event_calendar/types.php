<?php

defined('C5_EXECUTE') or die("Access Denied.");

class DashboardEventCalendarTypesController extends Controller
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



        if (!empty($_POST)){
            $isSomeValueEmpty = false;
            foreach ($_POST as $key => $value) {
                if ($value === "" && $key !== "typeID") {
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
        }


        $types = $db->GetAll("SELECT ECT.*, count(ECE.eventID) as total_types FROM dsEventCalendarTypes AS ECT LEFT JOIN dsEventCalendarEvents AS ECE ON ECE.type = ECT.typeID group by ECT.typeID");
        $this->set('types', $types);


        $this->set('type','');
        $this->set('color','');
    }

    public function update()
    {
        if (isset($_POST) && is_numeric($_POST['id'])) {
            $db = Loader::db();
            $sql = "UPDATE dsEventCalendarTypes SET
            type = ?,
            color = ? 
            WHERE typeID=" . $this->post('id');
            $args = array(
                $this->post('type'),
                $this->post('color')
            );
            $db->Execute($sql, $args);
            die("OK");
        } else {
            die("ERROR");
        }
    }

    public function delete()
    {
        if (isset($_POST) && is_numeric($_POST['id'])) {
            $db = Loader::db();
            $sql = "DELETE FROM dsEventCalendarTypes WHERE typeID = " . $this->post('id');
            $db->Execute($sql);


            $sql2 = "UPDATE dsEventCalendarEvents SET
            type = 0
            WHERE type=" . $this->post('id');
            $db->Execute($sql2);
            die("OK");
        } else {
            die("ERROR");
        }
    }
}