<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Model_Resource_Custombanktransfer_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract{
	protected function _construct(){
		$this->_init('custombanktransfer/custombanktransfer');
	}
}