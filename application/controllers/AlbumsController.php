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
     * Displays info on a specific album
     */
    public function showAction()
    {
        $album = $this->_getAlbumById($this->_getParam('id'));
        $this->view->album = $album;
        $this->view->artist = $album->findParentRow('Model_Artist');
    }
    
    protected function _getAlbumById($id)
    {
        return $this->_getModel()->fetchRow("id = $id");
    }
    
    protected function _getModel()
    {
        return new Model_Album();
    }
}
