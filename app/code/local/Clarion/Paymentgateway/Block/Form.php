<?php

class Clarion_Paymentgateway_Block_Form extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('paymentgateway/form.phtml');
    }
}