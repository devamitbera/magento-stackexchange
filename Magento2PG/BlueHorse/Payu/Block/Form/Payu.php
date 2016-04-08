<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace BlueHorse\Payu\Block\Form;

/**
 * Block for Bank Transfer payment method form
 */
class Payu extends \Magento\OfflinePayments\Block\Form\AbstractInstruction
{
    /**
     * Bank transfer template
     *
     * @var string
     */
    protected $_template = 'form/payu.phtml';
}
