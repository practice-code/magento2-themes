<?php

class M3_Cusdesign_Block_Adminhtml_Cusdesign_File extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $getData = $row->getData();
		if($getData['filename'] != "")
		{
			echo "<a href=".Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$getData['filename']." target='_blank' download> Download Attachment</a>";
		}
    }

}
