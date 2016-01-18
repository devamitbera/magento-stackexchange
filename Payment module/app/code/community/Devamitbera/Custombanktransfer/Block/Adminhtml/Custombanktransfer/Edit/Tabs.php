<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Block_Adminhtml_Custombanktransfer_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {
    //put your code here
 public function __construct()
    {
        parent::__construct();
        $this->setId('custombanktransfer_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('custombanktransfer')->__('Bank Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('custombanktransfer')->__('Bank Information'),
            'title'     => Mage::helper('custombanktransfer')->__('Bank Information'),
            'content'   => $this->getLayout()->createBlock('custombanktransfer/adminhtml_custombanktransfer_edit_tab_form')->toHtml(),
        ))
        ;

        return parent::_beforeToHtml();
    }    
}
