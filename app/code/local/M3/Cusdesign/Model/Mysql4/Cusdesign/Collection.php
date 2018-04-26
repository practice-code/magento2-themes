<?php

class M3_Cusdesign_Model_Mysql4_Cusdesign_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('cusdesign/cusdesign');
    }
}