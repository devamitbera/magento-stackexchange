<?php
class Dev_Productreview_Model_Observer{
	
	public function add($observer){
		
		$identifier=$observer->getEvent()->getCondition();
		Mage::log('aaa', null, 'logfile.log');
	
	}
	
}