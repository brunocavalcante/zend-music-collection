<?php
/**
 * Zend_Form for the Albums
 *
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package zend-music-collection
 * @since 2011-09-22
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @see Zend_Form
 */
class Form_Album extends Zend_Form
{
    public function init()
    {
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
             ->setRequired(true);
        $this->addElement($name);

        $year = new Zend_Form_Element_Text('year');
        $year->setLabel('Release Year');
        $this->addElement($year);

        $artist = new Zend_Form_Element_Select('artist_id');
        $artist->setLabel('Artist')
               ->setRequired(true);
        $this->addElement($artist);

        $submit = new Zend_Form_Element_Submit('Salvar');
        $this->addElement($submit);
    }
}
