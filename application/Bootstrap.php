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
    private function _getView()
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
    private function _getBaseUrl()
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
    
    protected function _initPlugins()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Plugin_Auth());
    }
    
    protected function _initNavigation()
    {
        $this->_getView()->navigation($this->_getNavigation());
    }
    
    /**
     * Returns the Zend_Navigation object that describes the sitemap
     * 
     * With the Zend_Navigation object, we can now use the navigation() view helpers, such as menu and breadcrumbs
     * 
     * @return Zend_Navigation
     */
    private function _getNavigation()
    {
        $container = new Zend_Navigation(array(
            array(
                'label' => 'Artists',
                'controller' => 'artists',
                'action' => 'index', 
                'pages' => array(
                    array(
                        'label' => 'Details',
                        'controller' => 'artists', 
                        'action' => 'show', 
                        'visible' => false, 
                        'resetParams' => false, 
                        'pages' => array(
                            array(
                                'label' => 'Edit',
                                'controller' => 'artists', 
                                'action' => 'edit', 
                            )
                        )
                    ), 
                    array(
                        'label' => 'New',
                        'controller' => 'artists', 
                        'action' => 'new', 
                        'visible' => false
                    )
                )
            ), 
            array(
                'label' => 'Albums',
                'controller' => 'albums',
                'action' => 'index', 
                'pages' => array(
                    array(
                        'label' => 'Details',
                        'controller' => 'albums', 
                        'action' => 'show', 
                        'visible' => false, 
                        'resetParams' => false, 
                        'pages' => array(
                            array(
                                'label' => 'Edit',
                                'controller' => 'albums', 
                                'action' => 'edit', 
                            )
                        )
                    ), 
                    array(
                        'label' => 'New',
                        'controller' => 'albums', 
                        'action' => 'new', 
                        'visible' => false
                    )
                )
            )
        ));
        
        return $container;
    }
}