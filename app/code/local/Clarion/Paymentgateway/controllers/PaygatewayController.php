<?php

class Clarion_Paymentgateway_PaygatewayController extends Mage_Core_Controller_Front_Action {

// redirect action method
    public function redirectAction() {
        
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template', 'paymentgatewaytemplate', array('template' => 'paymentgatewaytemplate/redirect.phtml'));
        $this->getLayout()->getBlock('content')->append($block);

        $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
        //$order->setStatus("pending_payment");
        //$order->save();
        //$order->sendNewOrderEmail();

        $this->renderLayout();
    }

    public function successAction() {
        $result = $_GET['response'];
        if($result){
            $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
            $redirect_url = (Mage::getSingleton('customer/session')->isLoggedIn()) ? 'customer/account' : '/';
            switch ($result) {
                case '1':
                    $message = 'Pago procesado exitosamente. Codigo de autorizacion: ' . $_GET['authcode'];
                    $order->setData('state', "complete");
                    $order->setStatus("payment_complete");
                    $redirect_url = 'checkout/onepage/success?pay=1';
                    break;
                case '2':
                    $message = 'Operacion de pago denegada. Respuesta del sistema de pago: ' . $_GET['response_text'];
                    Mage::getSingleton('core/session')->addError('Operacion de pago denegada. Por favor contacte a un administrador para resolver el problema.');
                    break;
                case '3':
                    $message = 'Ocurrio un error al intentar el pago. Respuesta del sistema de pago: ' . $_GET['response_text'];
                    Mage::getSingleton('core/session')->addError('Error al intentar el pago. Por favor contacte a un administrador para completarlo.');
                    break;
                default:
                    $message = 'El pago no fue completado. Respuesta del sistema de pago: ' . $_GET['response_text'];
            }
            $history = $order->addStatusHistoryComment($message, false);
            $history->setIsCustomerNotified(false);
            $order->save();

        } else {
            $redirect_url = (Mage::getSingleton('customer/session')->isLoggedIn()) ? 'customer/account' : '/';
            Mage::getSingleton('core/session')->addError('Ocurrió un error al procesar su pago. Por favor contacte a un administrador para resolver el problema.');
        }

        $this->_redirect($redirect_url, array('_secure' => true));
            
    }

    // cancel action will hit when some one cancel the order and state changes to canceled
    public function cancelAction() {
        if (Mage::getSingleton('checkout/session')->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
            if ($order->getId()) {
                // Flag the order as 'cancelled' and save it
                $order->cancel()->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, 'El usuario cancelo el proceso de pago.')->save();
            }
        }
    }

}
