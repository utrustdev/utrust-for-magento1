<?php

class Utrust_Payment_PaymentController extends Mage_Core_Controller_Front_Action {

    public function redirectAction() 
    {
        $orderId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
        if ($orderId) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);
            if($order->getId()) {
                $api = Mage::getModel("utrust_payment/api");
                $result = $api->pay($order);
                if(isset($result["data"]["type"]) && $result["data"]["type"] === "orders_redirect" 
                        && isset($result["data"]["attributes"]["redirect_url"])){
                    $payment = $order->getPayment();
                    $payment->setUtrustPaymentId($result["data"]["id"]);
                    $payment->save();
                    Mage::app()->getResponse()->setRedirect($result["data"]["attributes"]["redirect_url"])->sendResponse();
                    exit();
                }
                elseif(isset($result["errors"])){
                    foreach($result["errors"] as $error){
                        Mage::log($error['detail'], null, 'utrust.log');
                    }
                }
            }
        }
        Mage::getSingleton('core/session')->addError(__("Your payment didn't go through. Please try a different payment method or try again later.")); 
        Mage_Core_Controller_Varien_Action::_redirect('utrust/payment/cancel');
    }

    public function responseAction() 
    {
        $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());
        if($order->getId() && $order->getPayment()->getMethod() === 'utrust') {
            $this->_redirect('checkout/onepage/success');
        } else {
            Mage_Core_Controller_Varien_Action::_redirect('/');
        }
    }


    public function cancelAction() 
    {
        $orderId = Mage::getSingleton('checkout/session')->getLastRealOrderId();
        if ($orderId) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($orderId);
            $session = Mage::getSingleton('checkout/session');
            $cart = Mage::getSingleton('checkout/cart');
            if ($order->getId()) {
                $session->getQuote()->setIsActive(false)->save();
	        $session->clear();
                $order->cancel()->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, 'Gateway has canceled the payment.')->save();
                $items = $order->getItemsCollection();
        	foreach ($items as $item) {
                    try {
                        $cart->addOrderItem($item);
                    } catch (Mage_Core_Exception $e) {
                        $session->addError($this->__($e->getMessage()));
                        Mage::logException($e);
                        continue;
                    }
                }
                $cart->save();
            }
        }
        $this->_redirect('checkout/cart');
    }
    
    public function callbackAction()
    {
        try{
            $helper = Mage::helper("utrust_payment");
            $payload = json_decode($this->getRequest()->getRawBody(), true);
            $signature = $helper->getPayloadSignature($payload);
            if(isset($payload["signature"]) && $payload["signature"] === $signature){
                if(isset($payload["event_type"]) && $payload["event_type"] === 'ORDER.PAYMENT.RECEIVED') {
                    $order = Mage::getModel('sales/order')->loadByIncrementId($payload["resource"]["reference"]);
                    $payment = $order->getPayment();
                    if($order->getId() && $payment->getMethod() === 'utrust') {
                        if($order->canInvoice()){
                            $invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();
                            $invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_OFFLINE);
                            $invoice->register();
                            $transaction = Mage::getModel('core/resource_transaction')
                                ->addObject($invoice)
                                ->addObject($invoice->getOrder());
                            $transaction->save();
                        }
                        $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
                        $msg = __('Utrust Callback: ').$payload["event_type"]."<br/>".__("Amount: ").$payload["resource"]["currency"]." ".$payload["resource"]["amount"];
                        $history = $order->addStatusHistoryComment($msg, false);
                        $history->setIsCustomerNotified(false);
                        $order->save();
                    }
                }
            }
        }
        catch(Exception $e){
            Mage::log($e->getMessage(), null, "utrust.log");
        }
    }

}
