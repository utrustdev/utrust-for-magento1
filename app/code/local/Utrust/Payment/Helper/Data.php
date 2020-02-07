<?php

class Utrust_Payment_Helper_Data extends Mage_Core_Helper_Data
{

    /**
     *
     * @param Mage_Sales_Model_Order $order
     * @return array
     */
    public function getOrderData($order)
    {
        $items = array();
        foreach ($order->getAllVisibleItems() as $item) {
            $items[] = array(
                "sku" => $item["sku"],
                "name" => $item["name"],
                "price" => $item["base_price_incl_tax"],
                "currency" => $order->getBaseCurrencyCode(),
                "quantity" => (int) $item["qty_ordered"],
            );
        }
        $data = array(
            'data' => array(
                'type' => 'orders',
                'attributes' => array(
                    'order' => array(
                        'reference' => $order->getIncrementId(),
                        'amount' => array(
                            'total' => $order->getBaseGrandTotal(),
                            'currency' => $order->getBaseCurrencyCode(),
                            'details' => array(
                                'subtotal' => $order->getBaseSubtotal(),
                                'tax' => $order->getBaseTaxAmount(),
                                'shipping' => $order->getBaseShippingAmount(),
                                'discount' => $order->getBaseDiscountAmount(),
                            ),
                        ),
                        'return_urls' => array(
                            'return_url' => Mage::getUrl('utrust/payment/response', array('_secure' => true)),
                            'cancel_url' => Mage::getUrl('utrust/payment/cancel', array('_secure' => true)),
                            'callback_url' => Mage::getUrl('utrust/payment/callback', array('_secure' => true)),
                        ),
                        'line_items' => $items,
                    ),
                    'customer' => array(
                        'first_name' => $order->getCustomerFirstname(),
                        'last_name' => $order->getCustomerLastname(),
                        'email' => $order->getCustomerEmail(),
                        'address1' => $order->getBillingAddress()->getStreet1(),
                        'address2' => $order->getBillingAddress()->getStreet2(),
                        'city' => $order->getBillingAddress()->getCity(),
                        'state' => $order->getBillingAddress()->getRegion(),
                        'postcode' => $order->getBillingAddress()->getPostcode(),
                        'country' => $order->getBillingAddress()->getCountryId(),
                    ),
                ),
            ),
        );
        return $data;
    }

    /**
     *
     * @return boolean
     */
    public function isSandbox()
    {
        $store = Mage::app()->getStore();
        $sandbox = Mage::getStoreConfig('payment/utrust/sandbox', $store);

        return ($sandbox) ? true : false;
    }

    /**
     *
     * @return string
     */
    public function getApiKey()
    {
        $prefix = ($this->isSandbox()) ? 'test' : 'live';

        return Mage::getStoreConfig('payment/utrust/' . $prefix . '_api_key');
    }

    /**
     *
     * @return string
     */
    public function getWebhooksSecret()
    {
        $prefix = ($this->isSandbox()) ? 'test' : 'live';

        return Mage::getStoreConfig('payment/utrust/' . $prefix . '_webhooks_secret');
    }

    /**
     *
     * @param array $payload
     * @return string
     */
    public function getPayloadSignature($payload)
    {
        unset($payload["signature"]);
        $payload = $this->_array_flatten($payload);
        ksort($payload);
        $msg = implode("", array_map(function ($v, $k) {return $k . $v;}, $payload, array_keys($payload)));

        $secret = $this->getWebhooksSecret();

        $signed_message = hash_hmac("sha256", $msg, $secret);
        return $signed_message;
    }

    protected function _array_flatten(array $array, $parentKey = '')
    {
        $result = array();
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                $result = array_merge($result, $this->_array_flatten($val, $key));
            } else {
                $result[$parentKey . $key] = $val;
            }
        }
        return $result;
    }

}
