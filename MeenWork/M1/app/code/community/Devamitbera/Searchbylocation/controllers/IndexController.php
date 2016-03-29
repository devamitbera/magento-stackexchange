<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
class Devamitbera_Searchbylocation_IndexController extends Mage_Core_Controller_Front_Action{
	public function saveLastLongAction(){
		
		$cookie = Mage::getSingleton('core/cookie');
		$cookie->set('latSearch', Mage::app()->getRequest()->getParam('latSearch') ,time()+8640000);
		$cookie->set('longSearch', Mage::app()->getRequest()->getParam('longSearch') ,time()+8640000);
		}
}
