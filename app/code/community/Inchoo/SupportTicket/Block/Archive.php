<?php

class Inchoo_SupportTicket_Block_Archive extends Mage_Core_Block_Template
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('inchoo/tickets/archive.phtml');
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        $website_id = Mage::app()->getWebsite()->getId();
        if ($currentCustomer) {
            $ticketList = Mage::getResourceModel('inchoo_supportticket/ticket_collection')
                                ->addFieldToFilter('status', 0)
                                ->addFieldToFilter('customer_id', $currentCustomer->getId())
                                ->addFieldToFilter('website_id', $website_id);
        }
        $this->setTickets($ticketList);

        Mage::app()->getFrontController()->getAction()->getLayout()->getBlock('root')->setHeaderTitle(Mage::helper('inchoo_supportticket')->__('Tickets'));
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('page/html_pager', 'support_tickets_active_pager')
            ->setCollection($this->getTickets());
        $this->setChild('pager', $pager);
        $this->getTickets()->load();
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getAddTicketUrl() {
        return $this->getUrl('tickets/support/new', array('_secure'=>true));
    }

    public function getListTicketsUrl() {
        return $this->getUrl('tickets/support/list', array('_secure'=>true));
    }

    public function getArchiveUrl() {
        return $this->getUrl('tickets/support/archive', array('_secure'=>true));
    }
}