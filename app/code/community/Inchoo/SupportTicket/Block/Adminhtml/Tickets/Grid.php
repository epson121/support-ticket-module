<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('inchoo_supportticket');
        $this->setDefaultSort('ticket_id');
    }

    protected function _prepareCollection() {
        $website_id = Mage::app()->getWebsite()->getId();
        $collection = Mage::getModel('inchoo_supportticket/ticket')
                            ->getCollection();
        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
        //  $collection = Mage::getResourceModel($this->_getCollectionClass());
        // $collection->getSelect()->joinLeft('sales_flat_order_payment', 'sales_flat_order_payment.parent_id = main_table.entity_id',array('method','cc_last4'));
        // $this->setCollection($collection);
        // return parent::_prepareCollection();
    }

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
            ));
        $this->addColumn('content', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Content'),
            'type' => 'text',
            'index' => 'content',
            ));
        $this->addColumn('status', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Status'),
            'type'=> 'text',
            'width' => '200px',
            'index' => 'status',
            ));
        $this->addColumn('created_at', array(
            'header'=> Mage::helper('inchoo_supportticket')->__('Created at'),
            'type' => 'text',
            'width' => '170px',
            'index' => 'author',
            ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array('ticket_id' => $row->getTicketId()));
    }

}