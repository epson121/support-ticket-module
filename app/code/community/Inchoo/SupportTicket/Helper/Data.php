<?php

class Inchoo_SupportTicket_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     * get all comments of a ticket
     */
    public function getTicketComments($id) {
        $comments = null;
        if ($id != null) {
            $comments = Mage::getModel('inchoo_supportticket/ticket_comment')
                                ->getCollection()
                                ->addFieldToFilter('ticket_id', $id);
        }
        return $comments;
    }
}