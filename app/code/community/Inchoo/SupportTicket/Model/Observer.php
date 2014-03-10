<?php

/**
 * Observer used for sending email.
 * Only if it's allowed in configuration
 */
class Inchoo_SupportTicket_Model_Observer
{
    public function sendMailToAdmin($observer) {
        if (Mage::getStoreConfig('system/smtp/ticket_mail') == 1) {
            $customer = $observer->getEvent()->getCustomer();
            $data = $observer->getEvent()->getData();

            $adminMail = Mage::getModel('admin/user')->load(2)->getEmail();
            $emailTemplate = Mage::getModel('core/email_template')->loadDefault('inchoo_supportticket_email_template');
            $vars = array('customerName' => $customer->getName(),
                          'created_at' => $data["data"]["created_at"],
                          'subject' => $data["data"]["subject"]
                          );
            $emailTemplate->setSenderEmail(Mage::getStoreConfig('trans_email/ident_general/email', Mage::app()->getStore()->getStoreId()));
            $emailTemplate->setSenderName('System');
            $emailTemplate->setTemplateSubject('New Ticket');
            $emailTemplate->send($adminMail, "Admin", $vars);
        }
    }
}