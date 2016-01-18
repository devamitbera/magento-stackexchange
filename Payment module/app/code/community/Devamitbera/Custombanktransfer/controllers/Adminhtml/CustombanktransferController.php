<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/

class Devamitbera_Custombanktransfer_Adminhtml_CustombanktransferController extends  Mage_Adminhtml_Controller_Action{
    //put your code here
    public function indexAction(){
      $this->_title($this->__('Custombanktransfer'))->_title($this->__('Banks List'));
       $this->loadLayout();
       $this->_setActiveMenu('custombanktransfer/list');
       $this->_addBreadcrumb(Mage::helper('custombanktransfer')->__('List of Bank'), Mage::helper('custombanktransfer')->__('List of Bank'));
       $this->_addContent($this->getLayout()->createBlock('custombanktransfer/adminhtml_custombanktransfer'));
       $this->renderLayout();
        
    }
    
   public function newAction(){
       $this->_forward('edit');
   }
   
   public  function editAction(){
      $this->_title($this->__('Custombanktransfer'))->_title($this->__('Banks Details'));
      $this->loadLayout();    
      Mage::register('current_custombanktransfer',Mage::getModel('custombanktransfer/custombanktransfer'));
      $id=$this->getRequest()->getParam('id');
      
      if(!is_null($id)){
         // echo "on at";
          Mage::registry('current_custombanktransfer')->load($id);
      }
      $Custombanktransfer=Mage::registry('current_custombanktransfer');
      
      $this->_addBreadcrumb(Mage::helper('custombanktransfer')->__('Customer Bank Transfer'), Mage::helper('custombanktransfer')->__('Customer Bank Transfer'));
   
      if(!is_null($Custombanktransfer->getId())):
          $this->_addBreadcrumb(Mage::helper('custombanktransfer')->__('Customer Bank Transfer'), Mage::helper('custombanktransfer')->__('Edit Existing Bank'));
        else:  
           $this->_addBreadcrumb(Mage::helper('custombanktransfer')->__('Customer Bank Transfer'), Mage::helper('custombanktransfer')->__('Add New Bank')); 
      endif;
      

      $this->_setActiveMenu('custombanktransfer/list');
      $this->_addContent($this->getLayout()->createBlock('custombanktransfer/adminhtml_custombanktransfer_edit'))
          ->_addLeft($this->getLayout()->createBlock('custombanktransfer/adminhtml_custombanktransfer_edit_tabs'));
      $this->renderLayout();
      
   }
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('custombanktransfer/custombanktransfer');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('custombanktransfer')->__('The bank has been deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Unable to find a poll to delete.'));
        $this->_redirect('*/*/');
    }
 
    /**
     * Save rating
     */
    public function saveAction()
    {
      

        if ($this->getRequest()->getPost()) {
            try {
                $Model = Mage::getModel('custombanktransfer/custombanktransfer');
                 if( $this->getRequest()->getParam('id') > 0 ) {
                    $Model->setId($this->getRequest()->getParam('id'));
                    
                }
                if( !$this->getRequest()->getParam('id') ) {
                    $Model->setCreated(now());
                }
               $Model->addData($this->getRequest()->getPost());
               $Model->save(); 
               

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('The Banks has been saved.'));
                Mage::getSingleton('adminhtml/session')->setCustombanktransferData(false);
                
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $Model->getId()));
                    return;
                }

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setCustombanktransferData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }
    
   public function _isAllowed() {
      return Mage::getSingleton('admin/session')->isAllowed('custombanktransfer/list');
    
   }
}
