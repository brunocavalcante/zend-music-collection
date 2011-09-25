<?php
/**
 * Controller for the Artists' management
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package zend-music-collection
 * @since 2011-09-20
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class ArtistsController extends Zend_Controller_Action
{
    /**
     * Displays the Artists
     */
    public function indexAction()
    {
        //instantiates a Zend_Db_Table_Select object (by default, will return all rows from the table)
        $select = $this->_getModel()->select();
      
        //Order by name
        $select->order('name');
      
        //setting up the Zend_Paginator with the select object
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($select));
        
        //tries to get the current page number from the URL param "page" (defaults to 1)
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        
        //sends the paginator object to the view
        $this->view->paginator = $paginator;
    }
    
    /**
     * Returns the artist's Model
     * 
     * @return Model_Artist
     */
    private function _getModel()
    {
        return new Model_Artist();
    }
    
    /**
     * Creates a new Artist
     */
    public function newAction()
    {
        $form = new Form_Artist();
        
        if ($this->getRequest()->isPost() AND $form->isValid($_POST)) {
            //creates a new artist, and sets its attributes from the postData
            //keys from the postData must match the table's column name for this to work
            $artist = $this->_getModel()->createRow($this->getRequest()->getPost());
            
            //saves the new artist
            $artist->save();
            
            //redirects back to the index action
            $this->_helper->redirector('index');
        }
        
        $this->view->form = $form;
    }
    
    /**
     * Displays info on a specific artist
     */
    public function showAction()
    {
        //loads the artist
        $artist = $this->_getArtistById($this->_getParam('id'));
        
        //sends it to the view
        $this->view->artist = $artist;
        
        //loads and sends its albums to the view
        $this->view->albums = $artist->findDependentRowset('Model_Album');
    }
    
        /**
     * Loads the artist by the ID
     * 
     * @param integer $id
     * @return Zend_Db_Table_Row
     */
    private function _getArtistById($id)
    {
        return $this->_getModel()->fetchRow("id = $id");
    }
    
    /**
     * Edits an artist
     */
    public function editAction()
    {
        $artist = $this->_getArtistById($this->_getParam('id'));
        $this->view->artist = $artist;
        
        //instantiates the artist's Form
        $form = new Form_Artist();
        
        //Checks if there submitted data and validates the form
        if ($this->getRequest()->isPost() AND $form->isValid($_POST)) {
            
            //updates the artist's attributes from the postData 
            //keys from the postData must match the table's column name for this to work
            $artist->setFromArray($this->getRequest()->getPost());
            
            //saves the modifications
            $artist->save();
            
            //redirects to the show action
            $this->_helper->redirector('show', 'artists', null, array('id' => $artist->id));
        }
        
        //fills the form input values with the artist's information
        //form input names must match the table's column name for this to work
        $form->populate($artist->toArray());
        
        //sends the form to the view
        $this->view->form = $form;
    }
}