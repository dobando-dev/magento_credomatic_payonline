<?php

class Clarion_Paymentgateway_Helper_Data extends Mage_Core_Helper_Abstract
{

public function getPaymentmethodPaymentgatewayurl()
{
	return Mage::getStoreConfig("payment/paymentgateway/cgi_url");
}

public function getKey()
{
	return Mage::getStoreConfig("payment/paymentgateway/key");
}

public function getKeyId()
{
	return Mage::getStoreConfig("payment/paymentgateway/key_id");
}

public function getProcessorId()
{
	return Mage::getStoreConfig("payment/paymentgateway/processor_id");
}


   
    
}