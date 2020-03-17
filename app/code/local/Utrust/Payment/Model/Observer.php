<?php

class Utrust_Payment_Model_Observer
{
    public function currencyValidator(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();
        $methodInstance = $event->getMethodInstance();

        if ('utrust' !== $methodInstance->getCode()) {
            return;
        }

        $quote   = $event->getQuote();
        $result = $event->getResult();

        $availableCurrencies = Mage::helper("utrust_payment")->getAvailableCurrencies();

        if (empty($availableCurrencies)) {
            $result->isAvailable = false;
        } else {
            $result->isAvailable = in_array($quote->getBaseCurrencyCode(), $availableCurrencies);
        }
    }
}
