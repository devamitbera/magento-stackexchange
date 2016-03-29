<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
$installer=$this;
$installer->startSetup();
$this->addAttribute('catalog_category', 'content_after_products', array(
		'type'                       => 'text',
		'label'                      => 'Content After Products',
		'input'                      => 'multiselect',
		'source'                     => 'categoryattribute/category_attribute_source_search',
		'backend'                     => 'categoryattribute/category_attribute_backend_search',
		'required'      => false,
		'sort_order'                 => 40,
		'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
		'group'                      => 'Display Settings',
	));
$installer->endSetup();