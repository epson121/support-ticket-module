<?php

class Inchoo_SupportTicket_Model_Observer
{
    public function sendMailToAdmin($observer) {
        if (Mage::getStoreConfig('system/smtp/ticket_mail') == 1) {
            $customer = $observer->getEvent()->getCustomer();
            $data = $observer->getEvent()->getData();


            $templateId = 'New ticket';

            $adminMail = Mage::getModel('admin/user')->load(2)->getEmail();
            // Mage::getModel('inchoo_supportticket/email')->sendEmail('inchoo_email_template',
            //     array('name' => 'System', 'email' => 'system@localho.st'),
            //     $adminMail,
            //     'System',
            //     'New ticket was created',
            //     array('customer' => $customer, 'data' => $data)
            // );
            // $emailTemplate = Mage::getModel('core/email_template')->loadDefault('inchoo_supportticket_email_template');
            // $vars = array('customerName' => '', 'productName' => 'Your Product');
            // // $emailTemplate->setSenderEmail("system@localho.st");
            // $emailTemplate->setSenderEmail(Mage::getStoreConfig('trans_email/ident_general/email', Mage::app()->getStore()->getStoreId()));
            // $emailTemplate->setSenderName("System");
            // var_dump($emailTemplate);
            // var_dump($emailTemplate->send($adminMail, "Admin", $vars));
            //
            // echo Mage::helper("adminhtml")->getUrl("adminhtml/inchoo_supportticket/edit", array('ticket_id' => 23));
            // echo Mage::getUrl("adminhtml/inchoo_supportticket/edit", array('ticket_id' => 23));
            $to = $adminMail;
            $subject = 'New ticket was opened';
            $message = 'Hello, new ticket was opened.';
            $headers = 'From: admin@magento.localhost' . "\r\n" .
                       'Reply-To: magento@localhost' . "\r\n" .
                       'X-Mailer: Luka';

            mail($to, $subject, $message, $headers);
        }
    }
}