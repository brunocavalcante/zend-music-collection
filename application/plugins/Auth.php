<?php
/**
 * Authentication Plugin
 * 
 * This plugin intercepts the requests and checks if the user is (or not) logged in
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package zend-music-collection
 * @since 2011-10-02
 */
class Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
    /**
     * This method is executed before the action
     * 
     * @link http://framework.zend.com/manual/en/zend.controller.action.html#zend.controller.action.prepostdispatch
     * @param Zend_Controller_Request_Abstract $request
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if (!Zend_Auth::getInstance()->hasIdentity() && $request->getControllerName() != 'auth') {
            $request->setControllerName('auth');
            $request->setActionName('login');
        }
    }
}