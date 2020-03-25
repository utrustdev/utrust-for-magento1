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
        $this->setTemplate('utrust/payment/form.phtml')->setMethodLabelAfterHtml($this->getImage());
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

    /**
     * @return string
     */
    private function getImage()
    {
        $html = "<img src='".$this->getSkinUrl('images/utrust-logo.png')."'
        style='float:left; max-width: 100px; margin-right: 10px;'/>";
        return $html;
    }
}
