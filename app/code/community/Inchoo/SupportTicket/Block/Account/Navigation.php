<?php

/**
 * Overridden for showing the dashboard in MyAccount
 */
class Inchoo_SupportTicket_Block_Account_Navigation extends Mage_Customer_Block_Account_Navigation
{
    protected function _construct()
    {
        $customerId =  Mage::getSingleton('customer/session')->getCustomer()->getId();
        $websiteId = Mage::app()->getWebsite()->getId();

        $unseenTickets = Mage::helper('inchoo_supportticket')->getOpenTicketsCount($customerId, $websiteId);
        // var_dump($unseenTickets);
        // die();
        $this->addLink('Test', 'tickets/support/list', 'My tickets <strong>('.$unseenTickets.')</strong>');
        parent::_construct();
    }
}