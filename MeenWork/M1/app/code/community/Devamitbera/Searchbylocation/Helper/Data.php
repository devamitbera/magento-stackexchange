<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class  Devamitbera_Searchbylocation_Helper_Data extends Mage_Core_Helper_Abstract{
	
	public function getVendorProductByLatLong(){
		
			$resource = Mage::getSingleton('core/resource');
			$readConnection = $resource->getConnection('core_read');
			
			$latSearch= Mage::getModel('core/cookie')->get('latSearch');
			$longSearch=Mage::getModel('core/cookie')->get('longSearch');
			$latSearch= 18.45;
			$longSearch=73.80;
			
			 $query = 'SELECT vendor_id, ( 6371 * acos( cos( radians('.$latSearch.') ) * cos( radians( SUBSTRING(position,1,17) ) ) * cos( radians( SUBSTRING(position,20,17)) - radians('.$longSearch.') ) + sin( radians('.$latSearch.') ) * sin( radians( SUBSTRING(position,1,17) ) ) ) ) AS distance FROM ag6_ves_vendor_map HAVING distance < 6 ORDER BY distance LIMIT 0 , 6';
			$results = $readConnection->fetchAll($query);
			$Vendorids=array();
			 foreach($results as $each){
				 $Vendorids[]= $each['vendor_id'];
			 }
			$product_ids=Mage::getModel('pricecomparison2/pricecomparison')->getCollection()
						->addFieldToFilter('vendor_id',array('in'=>$Vendorids))
			->getColumnValues('product_id');
			return $product_ids;

	}
}