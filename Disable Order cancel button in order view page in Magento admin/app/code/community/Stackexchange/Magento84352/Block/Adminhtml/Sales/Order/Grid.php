<?php

class Stackexchange_Magento84352_Block_Adminhtml_Sales_Order_Grid extends
Mage_Adminhtml_Block_Sales_Order_Grid{
    
    
    protected function _prepareMassaction()
    {
        parent::_prepareMassaction();
        

        $this->getMassactionBlock()->addItem('sprint_shipping_label', array(
             'label'=> Mage::helper('sales')->__('sPrint Shipping Labels'),
             'url'  => $this->getUrl('*/sales_order_shipment/massPrintShippingLabel'),
        ));
          $this->getMassactionBlock()->removeItem('cancel_order');    
        return $this;
    }
}
