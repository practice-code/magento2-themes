<?php

class M3_Cusdesign_Model_Mysql4_Cusdesign extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the cusdesign_id refers to the key field in your database table.
        $this->_init('cusdesign/cusdesign', 'cusdesign_id');
    }
}