<?php
class Model_Artist extends Zend_Db_Table_Abstract
{
    protected $_name = 'artists';
    protected $_primary = 'id';
    
    protected $_dependentTables = array('Model_Album');
}