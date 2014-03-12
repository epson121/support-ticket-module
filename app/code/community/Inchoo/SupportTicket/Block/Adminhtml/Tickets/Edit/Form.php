<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('inchoo/supportticket/ticket_data.phtml');
    }
}