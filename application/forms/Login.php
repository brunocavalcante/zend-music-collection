<?php
/**
 * Zend_Form for the Login Screen
 *
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package zend-music-collection
 * @since 2011-09-26
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @see Zend_Form
 */
class Form_Login extends Zend_Form
{
    public function init()
    {
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username')
                 ->setRequired(true);
        $this->addElement($username);

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                 ->setRequired(true);
        $this->addElement($password);
             
        $submit = new Zend_Form_Element_Submit('Login');
        $this->addElement($submit);
    }
}
