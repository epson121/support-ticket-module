<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Tab extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('adminhtml_tickets_edit_tab');
        $this->setDestElementId('adminhtml_tickets_edit');
        $this->setTitle('Support tickets');
    }
}