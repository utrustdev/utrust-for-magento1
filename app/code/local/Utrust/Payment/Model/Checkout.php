<?php

class Utrust_Payment_Model_Checkout extends Mage_Payment_Model_Method_Abstract
{
    const UTRUST_PAYMENT_METHOD_CODE = "utrust";
    
    protected $_code = self::UTRUST_PAYMENT_METHOD_CODE;
     
    protected $_canUseInternal = false;
    protected $_canUseForMultishipping = false;
	
    protected $_formBlockType = 'utrust_payment/form';
    protected $_infoBlockType = 'utrust_payment/info';
    
    /**
     * Check whether payment method can be used
     *
     * @param Mage_Sales_Model_Quote|null $quote
     * @return bool
     */
    public function isAvailable($quote = null)
    {
        $active = $this->getConfigData('active');
        return $active;
    }
    
    /**
     * Get checkout session namespace
     * @return Mage_Checkout_Model_Session
     */
    public function getCheckout()
    {
        return Mage::getSingleton('checkout/session');
    }
    
    /**
     * Get current quote
     *
     * @return Mage_Sales_Model_Quote
     */
    public function getQuote()
    {
        return $this->getCheckout()->getQuote();
    }
    
    /**
     * Return Order place redirect url
     *
     * @return string
     */
    public function getOrderPlaceRedirectUrl()
    {
          return Mage::getUrl('utrust/payment/redirect', array('_secure' => true));
    }
    
    /**
     * Get instructions text from config
     *
     * @return string
     */
    public function getInstructions()
    {
        return trim($this->getConfigData('instructions'));
    }

}