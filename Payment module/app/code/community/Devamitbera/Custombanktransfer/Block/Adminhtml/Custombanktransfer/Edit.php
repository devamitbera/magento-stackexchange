<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Block_Adminhtml_Custombanktransfer_Edit  extends  
Mage_Adminhtml_Block_Widget_Form_Container{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->_blockGroup = 'custombanktransfer';
        $this->_controller='adminhtml_custombanktransfer';
        $this->_objectId = 'id';
        $this->_updateButton('save', 'label', Mage::helper('custombanktransfer')->__('Save Bank Details'));
        $this->_updateButton('delete', 'label', Mage::helper('custombanktransfer')->__('Delete Bank Details'));
             $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
           

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
    public function getHeaderText() {
        if(Mage::registry('current_custombanktransfer') && Mage::registry('current_custombanktransfer')->getId()):
             return Mage::helper('custombanktransfer')->__("Edit  '%s'", $this->escapeHtml(Mage::registry('current_custombanktransfer')->getCbankName()));
            else:
                return Mage::helper('custombanktransfer')->__('New Bank');
        endif;
    }
}
