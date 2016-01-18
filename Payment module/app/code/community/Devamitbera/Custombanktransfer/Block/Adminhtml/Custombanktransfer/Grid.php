<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Custombanktransfer_Block_Adminhtml_Custombanktransfer_Grid extends Mage_Adminhtml_Block_Widget_Grid{
    
   public function __construct() {
       parent::__construct();
       $this->setId('custombanktransfer_id');
       $this->setDefaultSort('cbank_name');
       $this->setDefaultDir('ASC');
       $this->setSaveParametersInSession(true);
   } 
   
   protected function _preparecollection(){
         $collection = Mage::getModel('custombanktransfer/custombanktransfer')->getCollection();
         $this->setCollection($collection);
       parent::_preparecollection();
       return $this;
   }
   
   protected function _prepareColumns(){
       
          $this->addColumn('custombanktransfer_id', array(
            'header'    => Mage::helper('poll')->__('ID'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'custombanktransfer_id',
        ));

       $this->addColumn('cbank_name', array(
           'header' => Mage::helper('custombanktransfer')->__('Bank Name'),
           'align' =>'left',
           'index' => 'cbank_name',
           'align'     => 'left',
            'width' => '150px',
           
       ));
       $this->addColumn('cbank_branch',array(
          'index' =>'cbank_branch',
           'width' => '150px',
           'header' => Mage::helper('custombanktransfer')->__('Branch Name'),
           'align'     => 'left',
           
       ));
       $this->addColumn('cbank_account',array(
           'index' =>'cbank_account',
           'header' => Mage::helper('custombanktransfer')->__('Account no'),
           'width' => '100px',
           'align'     => 'left',
    
       ));
       $this->addColumn('cbank_type',array(
           'index' =>'cbank_type',
           'header' => Mage::helper('custombanktransfer')->__('Account Type'),
           'width' => '100px',
           'align'     => 'left',
    
       ));
       $this->addColumn('cbank_type',array(
           'index' =>'cbank_type',
           'header' => Mage::helper('custombanktransfer')->__('Account Type'),
           'width' => '50px',
           'align'     => 'left',
    
       ));
       

       
        $this->addColumn('active', array(
            'header'    => Mage::helper('poll')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'active',
            'type'      => 'options',
            'options'   => array(
                1 => 'Enabled',
                0 => 'Disbaled',
            ),
        ));
       $this->addColumn('created_at', array(
            'header'    => Mage::helper('poll')->__('Created At'),
            'align'     => 'left',
            'width'     => '50px',
            'type'      => 'datetime',
            'index'     => 'created_at',
            'format'	=> Mage::app()->getLocale()->getDateFormat()
        ));        
       $this->addColumn('updated_at', array(
            'header'    => Mage::helper('poll')->__('updated At'),
            'align'     => 'left',
            'width'     => '50px',
            'type'      => 'datetime',
            'index'     => 'updated_at',
            'format'	=> Mage::app()->getLocale()->getDateFormat()
        ));
       return parent::_prepareColumns();
      
   }
   
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}