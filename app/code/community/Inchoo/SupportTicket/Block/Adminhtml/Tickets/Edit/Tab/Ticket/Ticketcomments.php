<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Tab_Ticket_TicketComments extends Mage_Adminhtml_Block_Widget
{

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('inchoo/supportticket/ticket_comments.phtml');
    }

}