<?php

class Inchoo_SupportTicket_Model_Resource_TicketComment extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        // matches the table name and the primary key
        parent::_construct();
        $this->_init('inchoo_ticket/ticket_comment', 'ticket_comment_id');
    }
}