<?php
/**
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/

class  Devamitbera_Searchbylocation_Model_Layer  extends Mage_CatalogSearch_Model_Layer
{

    /**
     * Prepare product collection
     *
     * @param Mage_Catalog_Model_Resource_Eav_Resource_Product_Collection $collection
     * @return Mage_Catalog_Model_Layer
     */
    public function prepareProductCollection($collection)
    {
        $collection
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addSearchFilter(Mage::helper('catalogsearch')->getQuery()->getQueryText())
            ->setStore(Mage::app()->getStore())
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addStoreFilter()
            ->addUrlRewrite();
			$CurrentLocationProducts=Mage::helper('searchbylocation')->getVendorProductByLatLong();
			$productids = array_filter($CurrentLocationProducts);
			if(!empty($productids)):
			$collection->addIdFilter($productids);
			else:
			 	$condition = '';
				$collection->addFieldToFilter('entity_id', $condition);;
			endif;

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInSearchFilterToCollection($collection);

        return $this;
    }


}
