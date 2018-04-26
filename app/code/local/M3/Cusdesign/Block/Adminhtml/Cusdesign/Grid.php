<?php

class M3_Cusdesign_Block_Adminhtml_Cusdesign_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('cusdesignGrid');
      $this->setDefaultSort('cusdesign_id');
      $this->setDefaultDir('DESC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('cusdesign/cusdesign')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('cusdesign_id', array(
          'header'    => Mage::helper('cusdesign')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'cusdesign_id',
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('cusdesign')->__('Name'),
          'align'     =>'left',
          'index'     => 'name',
      ));

	  $this->addColumn('phone', array(
          'header'    => Mage::helper('cusdesign')->__('Phone No'),
          'align'     =>'left',
          'index'     => 'phone',
      ));
	  
	  $this->addColumn('email', array(
          'header'    => Mage::helper('cusdesign')->__('Email'),
          'align'     =>'left',
          'index'     => 'email',
      ));
	  
	  $this->addColumn('filename', array(
          'header'    => Mage::helper('cusdesign')->__('Filename'),
          'align'     =>'left',
          'index'     => 'filename',
		  'renderer' => 'M3_Cusdesign_Block_Adminhtml_Cusdesign_File',
      ));
	  
      $this->addColumn('message', array(
			'header'    => Mage::helper('cusdesign')->__('Message'),
			'width'     => '150px',
			'index'     => 'message',
      ));
	  
    
		
		$this->addExportType('*/*/exportCsv', Mage::helper('cusdesign')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('cusdesign')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('cusdesign_id');
        $this->getMassactionBlock()->setFormFieldName('cusdesign');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('cusdesign')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('cusdesign')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('cusdesign/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('cusdesign')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('cusdesign')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  

}