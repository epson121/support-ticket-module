<?php

class Inchoo_SupportTicket_Adminhtml_Inchoo_SupportticketController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Show grid with all tickets
     */
    public function indexAction() {
        $this->loadLayout()->_setActiveMenu('customer');
        $this->_addContent($this->getLayout()->createBlock('inchoo_supportticket/adminhtml_tickets'));
        $this->renderLayout();
    }

    /**
     * Show individual ticket with its comments
     * @return [type] [description]
     */
    public function editAction() {
        $ticketId = $this->getRequest()->getParam('ticket_id');
        if ($ticketId) {
            $ticket = Mage::getModel('inchoo_supportticket/ticket');
            if ($ticket->load($ticketId)) {
                Mage::register('loaded_ticket', $ticket);
                $this->loadLayout();
                $this->renderLayout();
                return $this;
            }
        }
        $this->_forward('noroute');
        return $this;
    }

    /**
     * called on button click in editAction, deletes the ticket
     */
    public function deleteAction() {
        $ticketId = $this->getRequest()->getParam('ticket_id');
        if ($ticketId) {
            $ticket = Mage::getModel('inchoo_supportticket/ticket');
            if ($ticket->load($ticketId)) {
                $ticket->deleteTicket($ticketId);
                $this->_redirect("adminhtml/inchoo_supportticket/index");
                return $this;
            }
        }
        $this->_redirect('noroute');
    }

    /**
     * Change status of the ticket (closes the ticket)
     */
    public function updateStatusAction() {
         try {
            $ticketId = $this->getRequest()->getParam('ticket_id');
            if($this->getRequest()->getPost() && !empty($ticketId)) {
                $ticketModel = Mage::getModel('inchoo_supportticket/ticket')->load($ticketId, 'ticket_id');
                $ticketModel->disableTicket($ticketId);
                $ticketModel->save();
                $successMessage = Mage::helper('inchoo_supportticket')->__('Status updated');
                Mage::getSingleton('core/session')->addSuccess($successMessage);
            } else{
                throw new Exception("Insufficient Data provided");
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->_redirect("adminhtml/inchoo_supportticket/index");
    }

    /**
     * Called when new comment is addded
     */
    public function newCommentAction() {
         try {
            $data = $this->getRequest()->getParams();
            $ticketCommentModel = Mage::getModel('inchoo_supportticket/ticket_comment');
            $customer = Mage::getSingleton('admin/session')->getUser();

            if($this->getRequest()->getPost() && !empty($data) && $data['ticket_comment_content'] != '') {
                $ticketCommentModel->updateTicketCommentData($customer, $data);
                $ticketCommentModel->save();
                $successMessage = Mage::helper('inchoo_supportticket')->__('New comment added');
                Mage::getSingleton('core/session')->addSuccess($successMessage);
            } else{
                //throw new Exception("Insufficient Data provided");
            }
        } catch (Mage_Core_Exception $e) {
            Mage::getSingleton('core/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->_redirectReferer();
    }

}