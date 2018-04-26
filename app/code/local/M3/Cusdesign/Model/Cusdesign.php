<?php

class M3_Cusdesign_Model_Cusdesign extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('cusdesign/cusdesign');
    }
}