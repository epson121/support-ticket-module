<?php

class Inchoo_SupportTicket_Model_Ticket_Comment extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        // resource model path
        // define the entity
        $this->_init('inchoo_supportticket/ticket_comment');
    }

    /**
     * Create new comment and save it to database
     */
    public function updateTicketCommentData($customer, $data)
    {
        try{
            if(!empty($data)) {
                $storeId = Mage::app()->getStore()->getStoreId();
                $this->setAuthor($customer->getName());
                $this->setTicketId($data['ticket_id']);
                $this->setContent($data['ticket_comment_content']);
                $this->setCreatedAt(date("Y-m-d H:i:s"));
            } else {
                throw new Exception("Error Processing Request: Insufficient Data Provided");
            }
        } catch (Exception $e){
            Mage::logException($e);
        }
        return $this;
    }
}