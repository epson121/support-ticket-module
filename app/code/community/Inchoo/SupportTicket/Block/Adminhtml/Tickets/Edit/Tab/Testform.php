<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Tab_Testform
        extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form_as',
            'method'    => 'post',
            ));
        $fieldset = $form->addFieldset('my_form', array('legend' => 'Add new ticket'));

        $fieldset->addField('data', 'text',
            array(
                'label' => 'Subject',
                'name' => 'ticket_subject',
                'class' => 'required-entry',
                required => true
            ));
        $fieldset->addField('admin', 'hidden',
            array(
                'label' => 'Subject',
                'name' => 'isAdmin',
                'value' => true,
                'class' => 'required-entry',
                required => true
            ));
       $fieldset->addField('textarea', 'textarea', array(
                            'label' => Mage::helper('inchoo_supportticket')->__('Content'),
                            'class' => 'required-entry',
                            'required' => true,
                            'name' => 'ticket_content',
                            'tabindex' => 1 ));

       $fieldset->addField('submit', 'submit', array(
                            'required' => true,
                            'value' => 'Submit',
                            'tabindex' => 1 ));
        $this->setForm($form);
        return parent::_prepareForm();
    }
}