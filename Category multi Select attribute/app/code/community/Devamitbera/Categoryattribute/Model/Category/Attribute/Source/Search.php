<?php
class Devamitbera_Categoryattribute_Model_Category_Attribute_Source_Search
    extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        /* Get Search Attribute Collection */
        $collection = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addVisibleFilter()->addFieldToFilter('is_searchable',1);
        if (is_null($this->_options)) {
            foreach ($collection as $attribute) {
                $this->_options[] = array(
                    'label' => Mage::helper('catalog')->__($attribute['frontend_label']),
                    'value' => $attribute['attribute_code']
                );
            }
        }
        return $this->_options;
    }
}