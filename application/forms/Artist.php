<?php
class Form_Artist extends Zend_Form
{
    public function init()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
             ->setRequired(true);
        $this->addElement($name);
             
        $submit = new Zend_Form_Element_Submit('Save');
        $this->addElement($submit);
    }
}