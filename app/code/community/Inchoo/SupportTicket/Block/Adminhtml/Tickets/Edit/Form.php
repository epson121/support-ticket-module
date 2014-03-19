<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    // protected function _construct()
    // {
    //     parent::_construct();
    //     $this->setTemplate('inchoo/supportticket/ticket_data.phtml');
    // }

    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array('id' => 'edit_form', 'action' => $this->getUrl('adminhtml/inchoo_supportticket/newticket'), 'method' => 'post'));
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}