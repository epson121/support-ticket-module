<?php

class Inchoo_SupportTicket_Model_TicketComment extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        // resource model path
        // define the entity
        $this->_init('inchoo_ticket/ticket_comment');
    }
}