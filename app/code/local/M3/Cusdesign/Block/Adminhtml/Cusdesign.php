<?php
class M3_Cusdesign_Block_Adminhtml_Cusdesign extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_cusdesign';
    $this->_blockGroup = 'cusdesign';
    $this->_headerText = Mage::helper('cusdesign')->__('customize design Manager');
	
    parent::__construct();
	$this->_removeButton('add');
  }
}