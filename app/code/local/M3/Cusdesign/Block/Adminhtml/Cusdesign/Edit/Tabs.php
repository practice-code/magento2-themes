<?php

class M3_Cusdesign_Block_Adminhtml_Cusdesign_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('cusdesign_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('cusdesign')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('cusdesign')->__('Item Information'),
          'title'     => Mage::helper('cusdesign')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('cusdesign/adminhtml_cusdesign_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}