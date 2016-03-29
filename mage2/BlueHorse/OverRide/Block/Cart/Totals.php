<?php
namespace BlueHorse\OverRide\Block\Cart;
class Totals extends \Magento\Checkout\Block\Cart\Totals
{
public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    \Magento\Customer\Model\Session $customerSession,
    \Magento\Checkout\Model\Session $checkoutSession,
    \Magento\Sales\Model\Config $salesConfig,
    array $layoutProcessors = [],
    array $data = []
) {
    parent::__construct($context, $customerSession, $checkoutSession, $salesConfig, $layoutProcessors, $data);
}

}
