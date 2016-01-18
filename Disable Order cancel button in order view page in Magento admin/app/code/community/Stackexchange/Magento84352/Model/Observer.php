<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Stackexchange_Magento84352_Model_Observer{
    public function adminhtmlWidgetContainerHtmlBefore($event)
{
    $block = $event->getBlock();

    if ($block instanceof Mage_Adminhtml_Block_Sales_Order_View) {
        $block->removeButton('order_cancel');
    }
  }
public function removeButtoncancel($observer)
{   
    $block = $observer->getEvent()->getBlock();
    if(get_class($block) =='Mage_Adminhtml_Block_Widget_Grid_Massaction'
        && $block->getRequest()->getControllerName() == 'sales_order')
    {
        
        echo $block->getCount();
       
    }
}

}