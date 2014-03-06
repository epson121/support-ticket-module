<?php

class Inchoo_SupportTicket_Block_List extends Mage_Core_Block_Template
{
    public function getAddTicketUrl() {
        return $this->getUrl('tickets/support/new', array('_secure'=>true));
    }

    public function getListTicketsUrl() {
        return $this->getUrl('tickets/support/list', array('_secure'=>true));
    }

    public function getTicketList($value='') {
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        if ($currentCustomer) {
            $customer_registries = Mage::getModel('inchoo_supportticket/ticket')
                                ->getCollection()
                                ->addFieldToFilter('customer_id', $currentCustomer->getId());
        }
        return $customer_registries;
    }
}