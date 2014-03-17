<?php

class Inchoo_SupportTicket_Model_Ticket extends Mage_Core_Model_Abstract
{
    protected function _construct() {
        // resource model path
        // define the entity
        $this->_init('inchoo_supportticket/ticket');
    }

    /**
     * Add new ticket
     */
    public function updateTicketData(Mage_Customer_Model_Customer $customer, $data) {
        try{
            echo $customer->getId();
            if(!empty($data)) {
                $this->setCustomerId($customer->getId());
                $this->setSubject($data['ticket_subject']);
                $this->setContent($data['ticket_content']);
                $this->setWebsiteId(Mage::app()->getStore()->getStoreId());
                $this->setStatus(1);
                $this->setCreatedAt(date("Y-m-d H:i:s"));
            } else {
                throw new Exception("Error Processing Request: Insufficient Data Provided");
            }
        } catch (Exception $e){
            Mage::logException($e);
        }
        return $this;
    }

    public function disableTicket($ticketId) {
        try{
            if(!empty($ticketId)) {
                $this->setStatus(0);
            } else {
                throw new Exception("Error Processing Request: Insufficient Data Provided");
            }
        } catch (Exception $e){
            Mage::logException($e);
        }
        return $this;
    }

    public function deleteTicket($ticketId) {
        try {
            if (!empty($ticketId)) {
                $this->delete();
            }
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }
}