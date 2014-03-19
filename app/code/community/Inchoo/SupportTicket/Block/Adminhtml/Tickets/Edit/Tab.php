<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Tab extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('adminhtml_tickets_edit_tab');
        $this->setDestElementId('edit_form');
        $this->setTitle('Support tickets');
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main_section', array(
            'label'     => Mage::helper('inchoo_supportticket')->__('Tickets'),
            'title'     => Mage::helper('inchoo_supportticket')->__('Tickets'),
            'content'   => $this->getLayout()->createBlock('inchoo_supportticket/adminhtml_tickets_edit_tab_ticket')->toHtml(),
            'active'    => true
        ));

        $this->addTab('test_grid', array(
            'label'     => Mage::helper('inchoo_supportticket')->__('Test Grid'),
            'title'     => Mage::helper('inchoo_supportticket')->__('Test Grid'),
            'content'   => $this->getLayout()->createBlock('inchoo_supportticket/adminhtml_tickets_edit_tab_testgrid')->toHtml(),
        ));

        $this->addTab('test_form', array(
            'label'     => Mage::helper('inchoo_supportticket')->__('Test Form'),
            'title'     => Mage::helper('inchoo_supportticket')->__('Test Form'),
            'content'   => $this->getLayout()->createBlock('inchoo_supportticket/adminhtml_tickets_edit_tab_testform')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}