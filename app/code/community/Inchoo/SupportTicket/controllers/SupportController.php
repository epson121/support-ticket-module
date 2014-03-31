<?php

class Inchoo_SupportTicket_SupportController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function newAction()
    {
        $ticketId = $this->getRequest()->getParam('ticket_id');
        if ($ticketId) {
            $ticket = Mage::getModel('inchoo_supportticket/ticket');
            if ($ticket->load($ticketId)) {
                Mage::register('loaded_ticket', $ticket);
            }
        }
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    /**
     * View opened tickets
     * @return [type] [description]
     */
    public function listAction() {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    /**
     * View individual ticket
     */
    public function viewAction() {
        $ticketId = $this->getRequest()->getParam('ticket_id');
        $isArchive = $this->getRequest()->getParam('archive');
        if ($ticketId) {
            $ticket = Mage::getModel('inchoo_supportticket/ticket');
            if ($ticket->load($ticketId)) {
                Mage::register('loaded_ticket', $ticket);
                $isArchive ? Mage::register('archive', true) : Mage::register('archive', false);
                $this->loadLayout();
                $this->renderLayout();
                return $this;
            }
        }
        $this->_forward('noroute');
        return $this;
    }

    /**
     * View closed (archived) tickets
     */
    public function archiveAction() {
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    /**
     * Generate invoices grid for ajax request
     */
    public function testAction()
    {
        $this->_initOrder();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('inchoo_supportticket/adminhtml_tickets_edit_tab_testgrid')->toHtml()
        );
    }

    /**
     * Receives the POST from newAction and saves the ticket
     * Dispatches the event for sending email notification
     */
    public function newticketAction() {
        try {
            $data = $this->getRequest()->getParams();
            if ($data['ticket_id'] != '') {
                $ticketModel = Mage::getModel('inchoo_supportticket/ticket');
                $ticketModel->load($data['ticket_id']);
            } else {
                $ticketModel = Mage::getModel('inchoo_supportticket/ticket');
            }
            $customer = Mage::getSingleton('customer/session')->getCustomer();

            if($this->getRequest()->getPost() && !empty($data)) {
                $ticketModel->updateTicketData($customer, $data);
                $ticketModel->save();
                $successMessage = Mage::helper('inchoo_supportticket')->__('New ticket created');
                Mage::getSingleton('core/session')->addSuccess($successMessage);

                // used for sending the email
                Mage::dispatchEvent('ticket_added_event_handle', array('customer' => $customer, 'data' => $ticketModel));
            } else {
                throw new Exception("Insufficient Data provided");
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
            $this->_redirect('tickets/support/list');
    }

    /**
     * Receives the POST when new comment is added
     */
    public function newCommentAction() {
         try {
            $data = $this->getRequest()->getParams();
            $ticketCommentModel = Mage::getModel('inchoo_supportticket/ticket_comment');
            $customer = Mage::getSingleton('customer/session')->getCustomer();

            if($this->getRequest()->getPost() && !empty($data)) {
                $ticketCommentModel->updateTicketCommentData($customer, $data);
                $ticketCommentModel->save();
                $successMessage = Mage::helper('inchoo_supportticket')->__('New comment added');
                Mage::getSingleton('core/session')->addSuccess($successMessage);
            } else {
                throw new Exception("Insufficient Data provided");
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->_redirectReferer();
    }

    public function deleteAction()
    {
        $ticketId = $this->getRequest()->getParam('ticket_id');
        if ($ticketId) {
            $ticket = Mage::getModel('inchoo_supportticket/ticket');
            if ($ticket->load($ticketId)) {
                $ticket->deleteTicket($ticketId);
                $this->_redirect('tickets/support/list');
                return $this;
            }
        }
        $this->_redirect('noroute');
    }

    /**
     * Checks if user is logged in before every request to this controller
     */
    public function preDispatch() {
        parent::preDispatch();
        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }
    }

}