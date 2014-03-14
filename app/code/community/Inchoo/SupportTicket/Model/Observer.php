<?php

/**
 * Observer used for sending email.
 * Only if it's allowed in configuration
 */
class Inchoo_SupportTicket_Model_Observer
{
    public function sendMailToAdmin($observer) {
        if (Mage::getStoreConfig('sales_email/order/enabled') == 1) {
            $senderName = Mage::getStoreConfig('sales_email/order/identity');
            $adminMail = Mage::getModel('admin/user')->load(2)->getEmail();
            $sender = Array('name' => $senderName,
                            'email' => Mage::getStoreConfig('trans_email/ident_general/email'));
            $templateId = Mage::getStoreConfig('sales_email/order/template');
            $store = Mage::app()->getStore();
            $vars = array('customer' => $customer);
            Mage::getModel('core/email_template')->sendTransactional($templateId,
                                                                     $sender,
                                                                     $adminMail,
                                                                     'Admin',
                                                                     $vars,
                                                                     $store->getId());
        }

        // if (Mage::getStoreConfig('system/smtp/ticket_mail') == 1) {
        //     $customer = $observer->getEvent()->getCustomer();
        //     $data = $observer->getEvent()->getData();

        //     $adminMail = Mage::getModel('admin/user')->load(2)->getEmail();
        //     // $emailTemplate = Mage::getModel('core/email_template')->loadDefault('inchoo_supportticket_email_template');
        //     // $emailTemplate->setSenderEmail(Mage::getStoreConfig('trans_email/ident_general/email', Mage::app()->getStore()->getStoreId()));
        //     // $emailTemplate->setSenderName('System');
        //     // $emailTemplate->setTemplateSubject('New Ticket');
        //     // $emailTemplate->send($adminMail, "Admin", $vars);
        // }
    }
}