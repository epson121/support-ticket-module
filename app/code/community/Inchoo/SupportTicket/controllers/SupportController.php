<?php

class Inchoo_SupportTicket_SupportController extends Mage_Core_Controller_Front_Action
{

     public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function listAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
        return $this;
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
        return $this;
    }

    public function newticketAction()
    {
         try {
            $data = $this->getRequest()->getParams();
            $ticketModel = Mage::getModel('inchoo_supportticket/ticket');
            var_dump(get_class($ticketModel));
            $customer = Mage::getSingleton('customer/session')->getCustomer();

            if($this->getRequest()->getPost() && !empty($data)) {
                $ticketModel->updateTicketData($customer, $data);
                var_dump($ticketModel);
                $ticketModel->save();
                $successMessage = Mage::helper('inchoo_supportticket')->__('Registry Successfully Created');
                Mage::getSingleton('core/session')->addSuccess($successMessage);
            } else{
                throw new Exception("Insufficient Data provided");
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->_redirect('tickets/support/*');
    }
}