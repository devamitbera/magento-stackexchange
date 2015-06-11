<?php
class Dev_Productreview_Controller_Router extends Mage_Core_Controller_Varien_Router_Abstract{
	/**
	 * Initialize Controller Router
	 *
	 * @param Varien_Event_Observer $observer
	 */
	
	public function initControllerRouters($observer){
		$front=$observer->getEvent()->getFront();
		$front->addRouter('productreview',$this);
		
	}
	
	
	/* validate and modify the  request
	 *  Params Zend_Controller_Request_Htt
	 */
 	public function match(Zend_Controller_Request_Http $request){
 		
 		/* If Magento Magento is not install then 
 		 * redirect to installer url
 		 */
 		If(!Mage::isInstalled()):
			Mage::app()->getFrontController()->getResponse()
				->setRedirect(Mage::getUrl('install'))
				->sendResponse();
 				 exit;
			
 		endif;
 		$requestPathInfo=trim($request->getPathInfo(),'/');
 		Mage::log('aaa'.$requestPathInfo.'StoreId'.Mage::app()->getStore()->getId(), null, 'logfile.log');
 		/* check -review-form not exit
 		 * then immediate return false
 		 */ 
 		if(strpos($requestPathInfo,'-review-form')==false):
 			return  false;
 		endif;
 		
 		/* get productut from url 
 			by  substr	 
 		 */
 		$producturl=str_replace('-review-form','',$requestPathInfo);
 		
 		$condition=new Varien_Object(array('product_url'=>$producturl,
 			'continue'=>true));
 		
 		Mage::dispatchEvent('productreview_controller_router_match_before', array(
 				'router'    => $this,
 				'condition' => $condition
 		));
 		
 		$identifier=$condition->getProductUrl();
 		
 		if($condition->getRedirectUrl()){
 			Mage::app()->getResponse()
 				->setRedirect($condition->getReDirectUrl())
 				->sendResponse();
 			$request->setDispatched(true);
 			return true;
 		}
 		
 		if(!$condition->getContinue()){
 			return  false;
 		}
 		/* now load product by url
 		 * 
 		 */
 		$Rewrite=Mage::getModel('core/url_rewrite')
 					->setStoreId(Mage::app()->getStore()->getId())
 					->loadByRequestPath($identifier);
 		
 		if(!$Rewrite->getId()):
 			return false;
 		endif;
 		// if product id is null then return false
 		
 		if(!$Rewrite->getProductId()):
 			return false;
 		endif;
 		
 		
 		$request->setModuleName('review') 
            ->setControllerName('product')
            ->setActionName('list')
        ->setParam('id', $Rewrite->getProductId());
 		$request->setAlias(
 				Mage_Core_Model_Url_Rewrite::REWRITE_REQUEST_PATH_ALIAS,
 				$identifier
 		);
 		
 		
 		return  true;
 		
 	}

	
}