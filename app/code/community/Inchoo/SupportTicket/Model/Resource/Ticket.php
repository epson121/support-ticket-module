<?php

class Inchoo_SupportTicket_Model_Resource_Ticket extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        // matches the table name and the primary key
        $this->_init('inchoo_ticket/ticket', 'ticket_id');
    }
}