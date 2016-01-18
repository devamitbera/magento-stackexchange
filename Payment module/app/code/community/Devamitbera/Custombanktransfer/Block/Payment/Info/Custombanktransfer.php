<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Block_Payment_Info_Custombanktransfer extends Mage_Payment_Block_Info{

		protected function _construct(){
		parent::_construct();
		$this->setTemplate('custombanktransfer/info.phtml');
	}
	public function haveBankDetails(){
		if($this->getInfo()->getCbankId()):
			return true;
		else:
			return false;
		endif;
	}
	public function getBankDetails(){
		
		return $this->getInfo();
	
	}

}