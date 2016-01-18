<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Model_Resource_Custombanktransfer extends Mage_Core_Model_Resource_Db_Abstract{
	
	protected function _construct(){
		$this->_init('custombanktransfer/custombanktransfer','custombanktransfer_id');
	}
        
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        if (!$object->getId()) {
            $object->setCreatedAt(Mage::getSingleton('core/date')->gmtDate());
        }
        $object->setUpdatedAt(Mage::getSingleton('core/date')->gmtDate());
        return $this;
    }
}