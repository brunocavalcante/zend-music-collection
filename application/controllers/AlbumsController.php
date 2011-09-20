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
