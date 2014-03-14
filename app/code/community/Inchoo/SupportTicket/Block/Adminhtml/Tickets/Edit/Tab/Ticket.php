<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Tab_Ticket
    extends Mage_Adminhtml_Block_Widget
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('inchoo/supportticket/ticket_main.phtml');
    }

    /**
     * Return Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('inchoo_supportticket')->__('Ticket information');
    }

    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('inchoo_supportticket')->__('Ticket information');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }
}
