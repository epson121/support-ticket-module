<?php

class Inchoo_SupportTicket_Block_Adminhtml_Tickets_Edit_Tab_Testform
        extends Mage_Adminhtml_Block_Widget_Form
            implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'method'    => 'post'
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
        $form->setAction($this->getUrl('adminhtml/inchoo_supportticket/newticket'));
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * Return Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('inchoo_supportticket')->__('Test form');
    }

    /**
     * Return Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('inchoo_supportticket')->__('Test form');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }
}