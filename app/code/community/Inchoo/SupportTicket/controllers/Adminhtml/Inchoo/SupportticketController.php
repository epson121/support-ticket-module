<?php

class Inchoo_SupportTicket_Adminhtml_Inchoo_SupportticketController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction() {
         // $this->loadLayout();
         // $this->renderLayout();

        $this->loadLayout()->_setActiveMenu('customer');
        // Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
        $this->_addContent($this->getLayout()->createBlock('inchoo_supportticket/adminhtml_tickets'));
        $this->renderLayout();
    }

    public function editAction() {
        $ticketId = $this->getRequest()->getParam('ticket_id');
        if ($ticketId) {
            $ticket = Mage::getModel('inchoo_supportticket/ticket');
            if ($ticket->load($ticketId)) {
                Mage::register('loaded_ticket', $ticket);
                $this->loadLayout()->_setActiveMenu('customer');
                $this->renderLayout();
                return $this;
            }
        }
        $this->_forward('noroute');
        return $this;
    }

}