<?php
 class Clarion_Paymentgateway_IndexController extends Mage_Core_Controller_Front_Action
{
   
   
   // redirect action method 
	public function redirectAction() {
		//$this->loadLayout();
        echo "calling";
		die;
		//$block = $this->getLayout()->createBlock('Mage_Core_Block_Template','mygateway',array('template' => 'mygateway/redirect.phtml'));
		//$this->getLayout()->getBlock('content')->append($block);
        //$this->renderLayout();
	}
	
	public function indexAction() {
	$this->loadLayout();
	$this->renderLayout();
	}

	
	}


?>