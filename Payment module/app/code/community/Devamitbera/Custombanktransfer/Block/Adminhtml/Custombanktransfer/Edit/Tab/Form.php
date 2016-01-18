<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Block_Adminhtml_Custombanktransfer_Edit_Tab_Form  extends Mage_Adminhtml_Block_Widget_Form{
    //put your code here
    protected function _prepareForm(){
            
        
        $form=new Varien_Data_Form();
        
        $fieldset = $form->addFieldset('custombanktransfer_form', array('legend'=>Mage::helper('custombanktransfer')->__('Bank information')));
        $fieldset->addField('cbank_name', 'text', array(
            'label'     => Mage::helper('custombanktransfer')->__('Bank Names'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'cbank_name',
        ));
        $fieldset->addField('cbank_branch', 'text', array(
            'label'     => Mage::helper('custombanktransfer')->__('Branch Names'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'cbank_branch',
        ));
        $fieldset->addField('cbank_type', 'text', array(
            'label'     => Mage::helper('custombanktransfer')->__('Branch Type'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'cbank_type',
        ));
        $fieldset->addField('cbank_account', 'text', array(
            'label'     => Mage::helper('custombanktransfer')->__('Account No'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'cbank_account',
        ));
         $fieldset->addField('active', 'select', array(
            'label'     => Mage::helper('custombanktransfer')->__('Status'),
            'name'      => 'active',
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('custombanktransfer')->__('Enabled'),
                ),

                array(
                    'value'     => 0,
                    'label'     => Mage::helper('custombanktransfer')->__('Disbaled'),
                ),
            ),
        ));
        
    
        if( Mage::getSingleton('adminhtml/session')->getCustombanktransferData() ) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getPollData());
            Mage::getSingleton('adminhtml/session')->setCustombanktransferData(null);
        } elseif( Mage::registry('current_custombanktransfer') ) {
         
            $form->setValues(Mage::registry('current_custombanktransfer')->getData());

        }

        $this->setForm($form);
      
        return parent::_prepareForm();
        
    }
}
