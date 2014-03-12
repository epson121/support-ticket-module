<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize form
     * Add standard buttons
     * Add "Save and Apply" button
     * Add "Save and Continue" button
     */
    public function __construct()
    {
        // (inchoo_supportticket/adminhtml_tickets_edit_form)
        $this->_blockGroup = 'inchoo_supportticket';
        $this->_controller = 'adminhtml_tickets';
        $this->_mode = 'edit';

        $this->setId('adminhtml_tickets_edit');

        parent::__construct();
        $this->removeButton('save');
        $this->removeButton('reset');
    }

    /**
     * Getter for form header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        $id = $this->getRequest()->getParam('ticket_id');
        return Mage::helper('inchoo_supportticket')->__('Ticket id: '.$id);
    }
}