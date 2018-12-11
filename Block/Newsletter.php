<?php
namespace Bolt\Newsletter\Block;

use Magento\Customer\Block\Newsletter as MagentoNewsletter;
use Magento\Catalog\Block\ShortcutInterface;

class Newsletter extends MagentoNewsletter implements ShortcutInterface
{
    /**
     * @var string
     */
    protected $_template = 'cart/newsletter_subscribe.phtml';

    /**
     * @return bool
     */
    protected function shouldRender()
    {
        return true;
    }

    /**
     * Get shortcut alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->getData('alias');
    }
}
