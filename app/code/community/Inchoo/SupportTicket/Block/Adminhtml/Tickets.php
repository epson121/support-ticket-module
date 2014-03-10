<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'inchoo_supportticket';
        $this->_controller = 'adminhtml_tickets';
        $this->_headerText = Mage::helper('inchoo_supportticket')->__('Tickets!');
        parent::__construct();
        $this->removeButton('add');
    }
}