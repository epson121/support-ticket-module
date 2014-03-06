<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('inchoo_supportticket');
        $this->setDefaultSort('ticket_id');
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('inchoo_supportticket/ticket')->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('ticket_id', array(
            'header' => Mage::helper('inchoo_supportticket')->__('ID'),
            'sortable' => true,
            'width' => '80px',
            'index' => 'ticket_id',
            'filter' => false
            ));
        $this->addColumn('subject', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Subject'),
            'type'=> 'text',
            'width' => '300px',
            'index' => 'subject',
            'filter' => false
            ));
        $this->addColumn('content', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Content'),
            'type' => 'text',
            'index' => 'content',
            'filter' => false
            ));
        $this->addColumn('status', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Status'),
            'type'=> 'text',
            'width' => '200px',
            'index' => 'status',
            'filter' => false
            ));
        $this->addColumn('created_at', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Created at'),
            'type' => 'text',
            'width' => '170px',
            'index' => 'created_at',
            'filter' => false
            ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array('ticket_id' => $row->getTicketId()));
    }

}