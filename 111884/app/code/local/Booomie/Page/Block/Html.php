<?php 
class Booomie_Page_Block_Html extends Mage_Page_Block_Html{

    public function getBodyClass()
    {
        /* detect current page is home and return
        * cms-page-view cms-home as body class  
         */
        $action = Mage::app()->getFrontController()->getAction();
        if($action->getFullActionName()=='cms_index_index'):
            return 'cms-page-view cms-home amit';
        endif;
        return $this->_getData('body_class');
    }
}
