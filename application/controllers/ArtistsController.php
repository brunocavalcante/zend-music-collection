<?php
class ArtistsController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbTableSelect($this->_getModel()->select()));
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        
        $this->view->paginator = $paginator;
    }
    
    public function showAction()
    {
        $artist = $this->_getArtistById($this->_getParam('id'));
        $this->view->artist = $artist; 
        $this->view->albums = $artist->findDependentRowset('Model_Album');
    }
    
    public function editAction()
    {
        $artist = $this->_getArtistById($this->_getParam('id'));
        $this->view->artist = $artist;
        
        $form = new Form_Artist();
        
        if ($this->getRequest()->isPost() AND $form->isValid($_POST)) {
            $artist->setFromArray($this->getRequest()->getPost());
            $artist->save();
            $this->_helper->redirector('show', 'artists', null, array('id' => $artist->id));
        }
        
        $form->populate($artist->toArray());
        $this->view->form = $form;
    }
    
    public function newAction()
    {
        $form = new Form_Artist();
        
        if ($this->getRequest()->isPost() AND $form->isValid($_POST)) {
            $artist = $this->_getModel()->createRow($this->getRequest()->getPost());
            $artist->save();
            $this->_helper->redirector('index');
        }
        
        $this->view->form = $form;
    }
    
    /**
     * @param integer $id
     * @return Zend_Db_Table_Row
     */
    private function _getArtistById($id)
    {
        return $this->_getModel()->fetchRow("id = $id");
    }
    
    /**
     * @return Model_Artist
     */
    private function _getModel()
    {
        return new Model_Artist();
    }
}