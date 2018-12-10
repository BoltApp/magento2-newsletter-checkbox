<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bolt\Newsletter\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Initialize dependencies.
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        array $data = []
    ) {
        $this->_checkoutSession = $checkoutSession; 
        parent::__construct($context);
    }

    /**
     * Get checkout session
     *
     * @return void|null
     */
    public function getCheckoutSession() 
    {
        return $this->_checkoutSession;
    } 

    /**
     * Set newsletter value to session
     *
     * @return void|null
     */
    public function execute()
    {
        $val = $this->getRequest()->getPost('chk');
        $this->getCheckoutSession()->setNewsletterChecked($val);
    }
}
