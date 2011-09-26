<?php
class Plugin_Auth extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        if (!Zend_Auth::getInstance()->hasIdentity() && $request->getControllerName() != 'auth') {
            $request->setControllerName('auth');
            $request->setActionName('login');
        }
    }
}