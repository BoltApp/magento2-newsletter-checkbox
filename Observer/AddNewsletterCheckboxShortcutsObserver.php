<?php

namespace Bolt\Newsletter\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;

/**
 * Class AddNewsletterCheckboxShortcutsObserver
 *
 * @package Bolt\Newsletter\Observer
 */
class AddNewsletterCheckboxShortcutsObserver implements ObserverInterface
{
    /**
     * Add Bolt Newsletter shortcut buttons
     *
     * @param EventObserver $observer
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Catalog\Block\ShortcutButtons $shortcutButtons */
        $shortcutButtons = $observer->getEvent()->getContainer();
        
        $params = [];

        // we believe it's \Magento\Framework\View\Element\Template
        $shortcut = $shortcutButtons->getLayout()->createBlock(
            \Bolt\Newsletter\Block\Newsletter::class,
            'navigation-newsletter-subscriptions-link',
            $params
        );

        if (!$observer->getEvent()->getIsCatalogProduct()) {
            $shortcut->setIsInCatalogProduct(
                $observer->getEvent()->getIsCatalogProduct()
            )->setShowOrPosition(
                $observer->getEvent()->getOrPosition()
            );

            $shortcutButtons->addShortcut($shortcut);
        }
    }
}
