<?php
/**
 * Controller for the Artists' management
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package zend-music-collection
 * @since 2011-09-20
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class AuthController extends Zend_Controller_Action
{
    public function loginAction()
    {
        $this->view->form = new Form_Login();
        
        if ($this->getRequest()->isPost() && $this->view->form->isValid($_POST)) {
            try {
                $this->_doAuthenticate($this->_getParam('username'), $this->_getParam('password'));
                $this->_helper->redirector('index', 'artists');
            } catch(Exception $e) {
                $this->view->messages = array($e->getMessage());
            }
        }
    }
    
    protected function _doAuthenticate($username, $password)
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        
        $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'username', 'password', 'MD5(?)');
        $authAdapter->setIdentity($username)
                    ->setCredential($password);
        
        $authReturn = Zend_Auth::getInstance()->authenticate($authAdapter);
        
        if (!$authReturn->isValid()) {
           throw new Exception(implode(', ', $authReturn->getMessages()));
        }
    }
    
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('login');
    }
}
