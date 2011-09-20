<?php
class Model_Album extends Zend_Db_Table_Abstract
{
    protected $_name = 'albums';
    protected $_primary = 'id';
    
    protected $_referenceMap = array(
        'Model_Artist' => array(
            'columns' => array('artist_id'),
            'refTableClass' => 'Model_Artist',
            'refColums' => array('id')
        )
    );
}