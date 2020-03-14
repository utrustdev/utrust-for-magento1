<?php

class Utrust_Payment_Block_Form extends Mage_Payment_Block_Form
{

    /**
     * Instructions text
     *
     * @var string
     */
    protected $_instructions;

    /**
     * Block construction. Set block template.
     */
    protected function _construct()
    {
        $paymentTitle = Mage::helper("utrust_payment")->getMethodTitle();
        $mark = Mage::getConfig()->getBlockClassName('core/template');
        $mark = new $mark;
        $mark->setTemplate('utrust/payment/form.phtml');
        $this->setTemplate('utrust/payment/instructions.phtml')
            ->setMethodTitle($paymentTitle)
            ->setMethodLabelAfterHtml($mark->toHtml());
        return parent::_construct();
    }

    /**
     * Get instructions text from config
     *
     * @return string
     */
    public function getInstructions()
    {
        if (is_null($this->_instructions)) {
            $this->_instructions = $this->getMethod()->getInstructions();
        }
        return $this->_instructions;
    }

}

