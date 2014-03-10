<?php

class Inchoo_SupportTicket_Block_List extends Mage_Core_Block_Template
{

    public function getAddTicketUrl() {
        return $this->getUrl('tickets/support/new', array('_secure'=>true));
    }

    public function getListTicketsUrl() {
        return $this->getUrl('tickets/support/list', array('_secure'=>true));
    }

    public function getArchiveUrl() {
        return $this->getUrl('tickets/support/archive', array('_secure'=>true));
    }

    /**
     * Get opened tickets
     */
    public function getTicketList($value='') {
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        $website_id = Mage::app()->getWebsite()->getId();
        if ($currentCustomer) {
            $ticketList = Mage::getModel('inchoo_supportticket/ticket')
                                ->getCollection()
                                ->addFieldToFilter('status', 1)
                                ->addFieldToFilter('customer_id', $currentCustomer->getId())
                                ->addFieldToFilter('website_id', $website_id);
        }
        return $ticketList;
    }

    /**
     * Get closed (archived) tickets
     */
    public function getArchivedList($value='') {
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        $website_id = Mage::app()->getWebsite()->getId();
        if ($currentCustomer) {
            $ticketList = Mage::getModel('inchoo_supportticket/ticket')
                                ->getCollection()
                                ->addFieldToFilter('status', 0)
                                ->addFieldToFilter('customer_id', $currentCustomer->getId())
                                ->addFieldToFilter('website_id', $website_id);
        }
        return $ticketList;
    }
}