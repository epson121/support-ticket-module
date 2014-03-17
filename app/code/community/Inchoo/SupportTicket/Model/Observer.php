<?php

/**
 * Observer used for sending email.
 * Only if it's allowed in configuration
 */
class Inchoo_SupportTicket_Model_Observer
{
    public function sendMailToAdmin($observer) {
        if (Mage::getStoreConfig('sales_email/order/enabled') == 1) {

            $customer = $observer->getEvent()->getCustomer();
            $data = $observer->getEvent()->getData();

            $senderName = Mage::getStoreConfig('sales_email/order/identity');
            $adminMail = Mage::getModel('admin/user')->load(2)->getEmail();
            $sender = Array('name' => $senderName,
                            'email' => Mage::getStoreConfig('trans_email/ident_general/email'));
            $templateId = Mage::getStoreConfig('sales_email/order/template');
            // $emailTemplate = Mage::getModel('core/email_template')->loadDefault('inchoo_supportticket_email_template');
            $url = Mage::helper('adminhtml')->getUrl("adminhtml/inchoo_supportticket/index");
            $store = Mage::app()->getStore();
            $vars = array('customername' => $customer['firstname']." ".$customer['lastname'],
                          'adminName' => 'Administrator',
                          'ticketId' => $data['data']['ticket_id'],
                          'ticketSubject' => $data['data']['subject'],
                          'url' => $url
                          );
            Mage::getModel('core/email_template')->sendTransactional($templateId,
                                                                     // $emailTemplate,
                                                                     $sender,
                                                                     $adminMail,
                                                                     'Admin',
                                                                     $vars,
                                                                     $store->getId());
        }

    }
}