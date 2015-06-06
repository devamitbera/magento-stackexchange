<?php
class Magento_Stackexchange70064_Model_Observer{
	
	public function addCustomerLoadLayout($observer)
	{
		$loggedIn = Mage::getSingleton('customer/session')->isLoggedIn();
		// add Handler when customer is loggedin
		if($loggedIn):
	
		$groupId = Mage::getSingleton('customer/session')->getCustomerGroupId();
		//Get customer Group name
		
		$group = Mage::getModel('customer/group')->load($groupId);
		Mage::log('sss'.$group->getName(),null,'am.log');
		
		// add handler to current layout
		$observer->getEvent()->getLayout()->getUpdate()
		->addHandle('customer_group_'.strtolower($group->getData('customer_group_code')));
		//Mage::log('customer_group_'.strtolower($group->getData('customer_group_code')), null, 'logfile.log');
		endif;
	
	}
}