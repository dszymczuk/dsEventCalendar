<?php     
defined('C5_EXECUTE') or die(_("Access Denied."));

class EventCalendarBlockController extends BlockController {

	protected $btName = "Event Calendar";
	protected $btDescription = "";
	public $btTable = 'btEventCalendar';
	public $btInterfaceWidth = '400';
	public $btInterfaceHeight = '200';
	protected $btWrapperClass = 'ccm-ui';
	
	public function getBlockTypeDescription() {
		return $this->btDescription;
	}
	
	public function getBlockTypeName() {
		return t("Event Calendar");
	}
	
	public function __construct($b = null){ 
		parent::__construct($b);
	}
	
	public function on_page_view() {

    }
    
    function save($data) {
//		$args['shortname'] = isset($data['shortname']) ? trim($data['shortname']) : '';
		$args['calendarID'] = isset($data['calendarID']) ? intval($data['calendarID']) : 0;
		parent::save($args);
	}
	
}
?>
