<?php
class Nine_Catalog_Model_Observer
{

			public function filterBlankImage(Varien_Event_Observer $observer)
			{
				
    $collection = $observer->getEvent()->getCollection();


  		/*	echo  $collection->getSelect()->joinLeft(
                array('_inventory_table' => $collection->getTable('cataloginventory/stock_item')),
                "_inventory_table.product_id = e.entity_id",
                array('is_in_stock')
            )
           	 ->order('is_in_stock asc')
			 */
           // 	->order('created_at DESC')
				;
				
				$cond = array(
            '{{table}}.use_config_manage_stock = 0 AND {{table}}.manage_stock=1 AND {{table}}.is_in_stock=1',
            '{{table}}.use_config_manage_stock = 0 AND {{table}}.manage_stock=0', );
      
            $cond[] = '{{table}}.use_config_manage_stock = 1';
				$collection->joinField(
					'inventory_in_stock',
					'cataloginventory/stock_item',
					'is_in_stock',
					'product_id=entity_id',
					'(' . join(') OR (', $cond) . ')'
				);
				 $collection->getSelect() ->order('inventory_in_stock DESC')->order('created_at DESC');
				
			}
		
}
