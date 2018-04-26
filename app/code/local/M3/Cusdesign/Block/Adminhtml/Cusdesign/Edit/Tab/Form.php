<?php

class M3_Cusdesign_Block_Adminhtml_Cusdesign_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('cusdesign_form', array('legend'=>Mage::helper('cusdesign')->__('Item information')));
     
      $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('cusdesign')->__('Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
      ));
	  
	  $fieldset->addField('email', 'text', array(
          'label'     => Mage::helper('cusdesign')->__('Email'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'email',
      ));
	  
	  $fieldset->addField('phone', 'text', array(
          'label'     => Mage::helper('cusdesign')->__('Phone'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'phone',
      ));

       
	  $fieldset->addField('message', 'editor', array(
          'name'      => 'message',
          'label'     => Mage::helper('cusdesign')->__('Message'),
          'title'     => Mage::helper('cusdesign')->__('Message'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
	  
	   $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('cusdesign')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('cusdesign')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('cusdesign')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('cusdesign')->__('Disabled'),
              ),
          ),
      ));
     
      
     
      if ( Mage::getSingleton('adminhtml/session')->getCusdesignData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getCusdesignData());
          Mage::getSingleton('adminhtml/session')->setCusdesignData(null);
      } elseif ( Mage::registry('cusdesign_data') ) {
          $form->setValues(Mage::registry('cusdesign_data')->getData());
      }
      return parent::_prepareForm();
  }
}