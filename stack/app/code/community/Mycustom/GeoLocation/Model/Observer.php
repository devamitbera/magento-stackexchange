<?php
class Mycustom_GeoLocation_Model_Observer
{

			public function getGeoLocation(Varien_Event_Observer $observer)
			{
						Mage::log("test",null,'cms.log');
			}
		
}
