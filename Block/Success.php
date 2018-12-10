<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bolt\Newsletter\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\ProductMetadataInterface;

/**
 * Class Success
 *
 * @package Bolt\Boltpay\Block\Checkout
 */
class Success extends Template 
{
	/**
     * @var ProductMetadataInterface
     */
    private $productMetadata;
    /**
     * @var Susbcribe
     */
    protected $subscriberFactory;

    /**
     * Success constructor.
     *
     * @param ProductMetadataInterface $productMetadata
     * @param Context                  $context
     * @param array                    $data
     */
    public function __construct(
        ProductMetadataInterface $productMetadata,
        Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->productMetadata = $productMetadata;
        $this->_checkoutSession = $checkoutSession; 
        $this->subscriberFactory= $subscriberFactory;
    }

    /**
     * @return bool
     */
    public function isAllowInvalidateQuote()
    {
        // Workaround for known magento issue - https://github.com/magento/magento2/issues/12504
        return (bool) (version_compare($this->getMagentoVersion(), '2.2.0', '<'));
    }

    /**
     * Get magento version
     *
     * @return string
     */
    private function getMagentoVersion()
    {
        return $this->productMetadata->getVersion();
    }

	/**
     * Get Order
     *
     * @return void|null
     */
    public function getNewsletterVal() {
        $newsletter_value = $this->_checkoutSession->getNewsletterChecked();
        if($newsletter_value == 1)
	    {
	       	$email = $this->getEmail();
	       	return $this->subscriberFactory->create()->subscribe($email);
	    }elseif($newsletter_value == 0)
	    {
	       	return true;
	    }
    }

    public function getEmail()
    {
        $order = $this->_checkoutSession->getLastRealOrder();
        return $order->getCustomerEmail();
    }

}