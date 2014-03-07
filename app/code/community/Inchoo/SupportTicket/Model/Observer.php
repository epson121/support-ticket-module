<?php

class Inchoo_SupportTicket_Model_Observer
{
    public function sendMailToAdmin($observer) {
        $customer = $observer->getEvent()->getCustomer();
        $data = $observer->getEvent()->getData();


        $templateId = 'New ticket';

        // HARDCODED ADMIN ID
        $adminMail = Mage::getModel('admin/user')->load(2)->getEmail();
        // Mage::getModel('inchoo_supportticket/email')->sendEmail('inchoo_email_template',
        //     array('name' => 'System', 'email' => 'system@localho.st'),
        //     $adminMail,
        //     'System',
        //     'New ticket was created',
        //     array('customer' => $customer, 'data' => $data)
        // );
        $emailTemplate = Mage::getModel('core/email_template')->loadDefault('inchoo_supportticket_email_template');
        $vars = array('customerName' => '', 'productName' => 'Your Product');
        // $emailTemplate->setSenderEmail("system@localho.st");
        $emailTemplate->setSenderEmail(Mage::getStoreConfig('trans_email/ident_general/email', Mage::app()->getStore()->getStoreId()));
        $emailTemplate->setSenderName("System");
        $emailTemplate->send($adminMail, "Admin", $vars);
    }
}