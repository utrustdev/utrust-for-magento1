<?php

class Utrust_Payment_Model_Source_Country
{
    private $options;

    public function toOptionArray()
    {
        if (!$this->options) {
            $options = Mage::getResourceModel('directory/country_collection')->loadData()->toOptionArray(false);

            $this->options = array_filter(
                $options,
                function ($option) {
                    return !in_array($option['value'], Mage::helper("utrust_payment")->getRestictedCountries()) ?
                        $option :
                        null;
                }
            );
        }

        return $this->options;
    }

}
