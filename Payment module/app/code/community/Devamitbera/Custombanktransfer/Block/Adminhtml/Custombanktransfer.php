<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Block_Adminhtml_Custombanktransfer extends  Mage_Adminhtml_Block_Widget_Grid_Container {
    //put your code here
   public function __construct()
    {
        $this->_blockGroup = 'custombanktransfer';
        $this->_controller = 'adminhtml_custombanktransfer';
        $this->_headerText = Mage::helper('poll')->__('Banks Manager');
        $this->_addButtonLabel = Mage::helper('poll')->__('Add New Bank');
        parent::__construct();
    }  
    
}
