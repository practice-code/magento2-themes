<?php
class M3_Cusdesign_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/cusdesign?id=15 
    	 *  or
    	 * http://site.com/cusdesign/id/15 	
    	 */
    	/* 
		$cusdesign_id = $this->getRequest()->getParam('id');

  		if($cusdesign_id != null && $cusdesign_id != '')	{
			$cusdesign = Mage::getModel('cusdesign/cusdesign')->load($cusdesign_id)->getData();
		} else {
			$cusdesign = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($cusdesign == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$cusdesignTable = $resource->getTableName('cusdesign');
			
			$select = $read->select()
			   ->from($cusdesignTable,array('cusdesign_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$cusdesign = $read->fetchRow($select);
		}
		Mage::register('cusdesign', $cusdesign);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			
			if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
			
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('filename');
					
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','doc','docx','pdf'));
					$uploader->setAllowRenameFiles(false);
					
					// Set the file upload mode 
					// false -> get the file directly in the specified folder
					// true -> get the file in the product like folders 
					//	(file.jpg will go in something like /media/f/i/file.jpg)
					$uploader->setFilesDispersion(false);
							
					// We set media as the upload dir
					$path = Mage::getBaseDir('media') . DS ;
					$uploader->save($path, $_FILES['filename']['name'] );
					
				} catch (Exception $e) {
		      
		        }
				$filepath = $path.$_FILES['filename']['name'] ;
		        //this way the name is saved in DB
	  			$data['filename'] = $_FILES['filename']['name'];
			}
	  			
	  			
			$model = Mage::getModel('cusdesign/cusdesign');		
			$model->setData($data);
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				 $message = "Name: ".$data['name']."\n";
				 $message .= "Phone: ".$data['phone']."\n";
				 $message .= "Email: ".$data['email']."\n";
				 $message .= "Message: ".$data['message']."\n";

				$model->save();
				
				
				 $mailTemplate = Mage::getModel('core/email_template');
				  $mailTemplate->setSenderName(Mage::getStoreConfig('trans_email/ident_support/name')); // use general Mage::getStoreConfig('trans_email/ident_general/name');
				  $mailTemplate->setSenderEmail(Mage::getStoreConfig('trans_email/ident_support/email')); // use general Mage::getStoreConfig('trans_email/ident_general/email')
				  $mailTemplate->setTemplateSubject('Work With Us Mail');
				  $mailTemplate->setTemplateText($message);
				  // add attachment
				  $mailTemplate->getMail()->createAttachment(
						  file_get_contents($filepath),
						  Zend_Mime::TYPE_OCTETSTREAM,
						  Zend_Mime::DISPOSITION_ATTACHMENT,
						  Zend_Mime::ENCODING_BASE64,
						  $data['filename']
				  );
				  
				  $to_email_arr = array("lalitmohanwd@gmail.com");
				  $to_name_arr = array("lalitmohanwd");
				  $mailTemplate->send($to_email_arr, $to_name_arr);
  
				Mage::getSingleton('core/session')->addSuccess(Mage::helper('cusdesign')->__('Form was successfully submit'));
				Mage::getSingleton('core/session')->setFormData(false);

				
				$this->_redirect('/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('core/session')->addError($e->getMessage());
                Mage::getSingleton('core/session')->setFormData($data);
                $this->_redirect('/', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('core/session')->addError(Mage::helper('cusdesign')->__('Unable to find item to save'));
        $this->_redirect('/');
	}
}