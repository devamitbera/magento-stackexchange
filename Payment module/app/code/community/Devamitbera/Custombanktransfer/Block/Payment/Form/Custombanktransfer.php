<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Block_Payment_Form_Custombanktransfer extends Mage_Payment_Block_Form{
	
	 protected $_BanksCollection;
	protected function _construct(){
		parent::_construct();
		$this->setTemplate('custombanktransfer/form.phtml');
	}
	
	protected function _getConfig()
    {
        return Mage::getSingleton('payment/config');
    }
	
	public function CurrrentAvaliableBanks(){
		if(is_null($this->_BanksCollection)){
			
			$this->_BanksCollection=Mage::getModel('custombanktransfer/custombanktransfer')
                                ->getCollection()->addFieldToFilter('active',1);
		}
	  return $this->_BanksCollection;
	}

}