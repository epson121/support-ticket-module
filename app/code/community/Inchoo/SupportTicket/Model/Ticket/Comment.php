<?php

class Inchoo_SupportTicket_Model_Ticket_Comment extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        // resource model path
        // define the entity
        $this->_init('inchoo_supportticket/ticket_comment');
    }


    public function updateTicketCommentData(Mage_Customer_Model_Customer $customer, $data)
    {
        try{
            if(!empty($data)) {
                //$type_id = Mage::getModel('inchoo_supportticket/ticket')->load($data['type_id'], 'code')->getTypeId();
                $storeId = Mage::app()->getStore()->getStoreId();
                if ($storeId === 0) { // request sent by admin
                    // userArray = Mage::getSingleton('admin/session')->getData();
                    // $userUsername = $user->getUser()->getUsername();
                    $this->setAuthor(Mage::getSingleton('admin/session')->getData()
                                                                        ->getUser()
                                                                        ->getUsername());
                } else {
                    $this->setAuthor($customer->getName());
                }
                $this->setTicketId($data['ticket_id']);
                $this->setContent($data['ticket_comment_content']);
                $this->setCreatedAt(date("Y-m-d H:i:s"));
            } else {
                //throw new Exception("Error Processing Request: Insufficient Data Provided");
            }
        } catch (Exception $e){
            Mage::logException($e);
        }
        return $this;
    }
}