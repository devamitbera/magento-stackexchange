<?php
 
namespace BlueHorse\Customer\Controller\Index;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
 
class Index extends Action
{
 
    /**
     * @param Context $context
     * @param StoreFactory $modelStoreFactory
	 * @param StoreDevicesFactory $modelStoreDevicesFactory
	 * @param StoreCategoryFactory $modelStoreCategoryFactory
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }
 
    public function execute()
    {
		echo 1;
		exit;
    }
}