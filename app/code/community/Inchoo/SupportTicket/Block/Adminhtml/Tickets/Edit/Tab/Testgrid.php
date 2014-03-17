<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Tab_Testgrid
    extends Mage_Adminhtml_Block_Widget_Grid
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('test_grid');
        $this->setUseAjax(true);
    }

    /**
     * Get all tickets for display in admin grid.
     * @return
     */
    protected function _prepareCollection()
    {
        $website_id = Mage::app()->getWebsite()->getId();
        $collection = Mage::getModel('inchoo_supportticket/ticket')
                            ->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Set columns to display in grid
     * @return
     */
    protected function _prepareColumns()
    {
        $this->addColumn('ticket_id', array(
            'header' => Mage::helper('inchoo_supportticket')->__('ID'),
            'width' => '80px',
            'index' => 'ticket_id'
            ));
        $this->addColumn('subject', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Subject'),
            'type'=> 'text',
            'width' => '300px',
            'index' => 'subject',
            'escape' => true
            ));
        $this->addColumn('content', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Content'),
            'type' => 'text',
            'index' => 'content',
            'escape' => true
            ));
        $this->addColumn('status', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Status'),
            'type'=> 'text',
            'width' => '200px',
            'index' => 'status',
            'escape' => true
            ));
        $this->addColumn('created_at', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Created at'),
            'type' => 'text',
            'width' => '170px',
            'index' => 'created_at',
            ));
        return parent::_prepareColumns();
    }

    /**
     * on row click, go to edit route and send ticket_id as parameter
     */
    public function getRowUrl($row) {
        return $this->getUrl("*/*/edit", array('ticket_id' => $row->getTicketId()));
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/test', array('_current' => true));
    }


    /**
     * Return Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('inchoo_supportticket')->__('Test grid');
    }

    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('inchoo_supportticket')->__('Test grid');
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