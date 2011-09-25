<?php
/**
 * Controller for the Albums' management
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package zend-music-collection
 * @since 2011-09-20
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class AlbumsController extends Zend_Controller_Action
{
    /**
     * Displays the albums
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
     * Returns the album's model
     * 
     * @return Model_Album
     */
    private function _getModel()
    {
        return new Model_Album();
    }
    
    /**
     * Creates a new Album
     */
    public function newAction()
    {
        $form = new Form_Album();
        
        if ($this->getRequest()->isPost() AND $form->isValid($_POST)) {
            //creates a new album, and sets its attributes from the postData
            //keys from the postData must match the table's column name for this to work
            $album = $this->_getModel()->createRow($this->getRequest()->getPost());
            
            //saves the new artist
            $album->save();
            
            //redirects back to the index action
            $this->_helper->redirector('index');
        }
        
        $this->view->form = $form;
    }
    
    /**
     * Displays info on a specific album
     */
    public function showAction()
    {
        $album = $this->_getAlbumById($this->_getParam('id'));
        $this->view->album = $album;
        $this->view->artist = $album->findParentRow('Model_Artist');
    }
    
    /**
     * Loads the album by the ID
     * 
     * @param integer $id
     * @return Zend_Db_Table_Row
     */
    private function _getAlbumById($id)
    {
        return $this->_getModel()->fetchRow("id = $id");
    }
    
    /**
     * Edits an album
     */
    public function editAction()
    {
        $album = $this->_getAlbumById($this->_getParam('id'));
        $this->view->album = $album;
        
        //instantiates the artist's Form
        $form = new Form_Album();
        
        //Checks if there submitted data and validates the form
        if ($this->getRequest()->isPost() AND $form->isValid($_POST)) {
            
            //updates the album's attributes from the postData 
            //keys from the postData must match the table's column name for this to work
            $album->setFromArray($this->getRequest()->getPost());
            
            //saves the modifications
            $album->save();
            
            //redirects to the show action
            $this->_helper->redirector('show', 'albums', null, array('id' => $album->id));
        }
        
        //fills the form input values with the album's information
        //form input names must match the table's column name for this to work
        $form->populate($album->toArray());
        
        //sends the form to the view
        $this->view->form = $form;
    }
}
