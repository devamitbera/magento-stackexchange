<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Model_Method_Custombanktransfer extends Mage_Payment_Model_Method_Abstract{
   const PAYMENT_METHOD_BANKTRANSFER_CODE = 'custombanktransfer';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_BANKTRANSFER_CODE;	
	
    protected $_formBlockType = 'custombanktransfer/payment_form_custombanktransfer';
    protected $_infoBlockType = 'custombanktransfer/payment_info_custombanktransfer';
	
    /**
     * Get instructions text from config
     *
     * @return string
     */
    public function getInstructions()
    {
        return trim($this->getConfigData('instructions'));
    }
    /**
     * Assign data to info model instance
     *
     * @param   mixed $data
     * @return  Mage_Payment_Model_Info
     */
	public function assignData($data){
		if(!($data instanceof Varien_Object)){
			$data=new Varien_Object($data);
		}
		$info=$this->getInfoInstance();
			$info->setCbankId($data->getCbankId());
				if($data->getCbankId()):
				$CustomPaymentModel=Mage::getModel('custombanktransfer/custombanktransfer')->load($data->getCbankId());
				
					if($CustomPaymentModel->getId()):
						$info->setCbankName($CustomPaymentModel->getCbankName());
						$info->setCbankBranch($CustomPaymentModel->getCbankBranch());
						$info->setCbankAccount($CustomPaymentModel->getCbankAccount());
						$info->setCbankType($CustomPaymentModel->getCbankType());
					endif;	
				endif;
		 if (!empty($data)) {
            //$this->getInfoInstance()->setAdditionalData(serialize($data));
        }		
		 return $this;
	}	

	public function prepareSave()
    {
        return $this;
    }
	public function validate()
  {
    parent::validate();
	 return $this;
       
  }

}