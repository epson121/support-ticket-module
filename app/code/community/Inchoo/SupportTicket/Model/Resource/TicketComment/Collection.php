<?php

class Inchoo_SupportTicket_Model_Resource_TicketComment_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        // model name
        $this->_init('inchoo_ticket/ticket_comment');
    }
}