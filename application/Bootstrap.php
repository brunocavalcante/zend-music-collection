<?php
/**
 * Sets up the Application
 * 
 * @author Bruno Cavalcante <brunofcavalcante@gmail.com>
 * @package zend-music-collection
 * @since 2011-09-20
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Initializes the <title> attribute
     */
    protected function _initTitle()
    {
        $view = $this->_getView();
        $view->headTitle('Zend Music Collection');
    }
  
    /**
     * Returns the View Object
     * 
     * @return Zend_View
     */
    protected function _getView()
    {
        $this->bootstrap('view');
        return $this->getResource('view');
    }
  
    /**
     * Initializes the CSS dependencies 
     */
    protected function _initCss()
    {
        $view = $this->_getView();
        $view->headLink()->appendStylesheet($this->_getBaseUrl() . '/css/zend-music-collection.css');
    }
    
    /**
     * Returns the base URL for the application
     * 
     * At this point, Zend doesn't know the baseUrl - yet.
     * 
     * @return string
     */
    protected function _getBaseUrl()
    {
        $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl(); 
        if (!$baseUrl) { 
          $baseUrl = rtrim(preg_replace( '/([^\/]*)$/', '', $_SERVER['PHP_SELF'] ), '/\\'); 
        }
        
        return $baseUrl; 
    }
    
    /**
     * Sets up the application's Doctype
     */
    protected function _initDoctype()
    {
        $view = $this->_getView();
        $view->doctype(Zend_View_Helper_Doctype::HTML5);
    }
}