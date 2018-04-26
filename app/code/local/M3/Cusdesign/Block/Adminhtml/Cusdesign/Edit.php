<?php

class M3_Cusdesign_Block_Adminhtml_Cusdesign_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'cusdesign';
        $this->_controller = 'adminhtml_cusdesign';
        
        $this->_updateButton('save', 'label', Mage::helper('cusdesign')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('cusdesign')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('cusdesign_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'cusdesign_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'cusdesign_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('cusdesign_data') && Mage::registry('cusdesign_data')->getId() ) {
           // return Mage::helper('cusdesign')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('cusdesign_data')->getTitle()));
        } else {
           // return Mage::helper('cusdesign')->__('Add Item');
        }
    }
}