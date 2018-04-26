<?php
class M3_Cusdesign_Block_Cusdesign extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getCusdesign()     
     { 
        if (!$this->hasData('cusdesign')) {
            $this->setData('cusdesign', Mage::registry('cusdesign'));
        }
        return $this->getData('cusdesign');
        
    }
}