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
        // Instantiates the Login Form
        $this->view->form = new Form_Login();
        
        if ($this->getRequest()->isPost() && $this->view->form->isValid($_POST)) {
            try {
                // Tries to authenticate
                $this->_doAuthenticate($this->_getParam('username'), $this->_getParam('password'));
                
                // Redirects to the artists controller
                $this->_helper->redirector('index', 'artists');
            } catch(Exception $e) {
                // Sends the error message to the view. 
                // We aren't using flashMessenger here, since there will be no redirection (flashMessenger requires
                // a redirection).
                $this->view->messages = array($e->getMessage());
            }
        }
    }
    
    /**
     * Authenticates (or tries to) the username/password
     * 
     * @param string $username
     * @param string $password
     */
    protected function _doAuthenticate($username, $password)
    {
        // Database default adapter (defined in configs/application.ini)
        $db = Zend_Db_Table::getDefaultAdapter();
        
        // Instantiates the Zend_Auth_Adapter_DbTable, that authenticates the user in a database table
        $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users', 'username', 'password', 'MD5(?)');
        
        // Defines the Identity (username) and Credential (password)
        $authAdapter->setIdentity($username)
                    ->setCredential($password);
        
        // Tries to authenticate. If successful, already saves the logged username in session.
        $authReturn = Zend_Auth::getInstance()->authenticate($authAdapter);
        
        // Checks if the authentication was successful
        if (!$authReturn->isValid()) {
            // Separates the many messages in a single comma-separated string and throws as an exception
            throw new Exception(implode(', ', $authReturn->getMessages()));
        }
    }
    
    public function logoutAction()
    {
        // Deletes the logged user's session
        Zend_Auth::getInstance()->clearIdentity();
        
        // Redirects back to the login screen
        $this->_helper->redirector('login');
    }
}
