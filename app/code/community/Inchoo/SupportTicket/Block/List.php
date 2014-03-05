<?php

class Inchoo_SupportTicket_Block_List extends Mage_Core_Block_Template
{
    public function getAddTicketUrl() {
        return $this->getUrl('tickets/support/new', array('_secure'=>true));
    }
}