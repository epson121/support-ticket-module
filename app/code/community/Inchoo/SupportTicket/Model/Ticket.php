<?php

class Inchoo_SupportTicket_Model_Ticket extends Mage_Core_Model_Abstract
{
    protected function _construct() {
        // resource model path
        // define the entity
        $this->_init('inchoo_ticket/ticket');
    }

    public function updateTicketData(Mage_Customer_Model_Customer $customer, $data) {
        try{
            if(!empty($data)) {
                //$type_id = Mage::getModel('inchoo_supportticket/ticket')->load($data['type_id'], 'code')->getTypeId();
                $this->setCustomerId($customer->getId());
                $this->setSubject($data['ticket_subject']);
                $this->setContent($data['ticket_content']);
                $this->setStatus(1);
            } else {
                throw new Exception("Error Processing Request: Insufficient Data Provided");
            }
        } catch (Exception $e){
            Mage::logException($e);
        }
        return $this;
    }
}