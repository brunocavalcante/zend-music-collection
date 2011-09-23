<?php
/**
 * Zend_Form for the Artists
 *
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package zend-music-collection
 * @since 2011-09-20
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @see Zend_Form
 */
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