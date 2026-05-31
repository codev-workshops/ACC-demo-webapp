<?php
/**
 * Copyright © Example Co. All rights reserved.
 */

declare(strict_types=1);

namespace Example\Storefront\Model;

use Example\Storefront\Api\CheckoutMessageInterface;

/**
 * Builds the storefront checkout message from the cart summary.
 */
class CheckoutMessageBuilder implements CheckoutMessageInterface
{
    /**
     * @param CartSummaryProvider $cartSummaryProvider
     */
    public function __construct(private readonly CartSummaryProvider $cartSummaryProvider)
    {
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return sprintf('Checkout — %s', $this->cartSummaryProvider->getSummaryLine());
    }

    /**
     * Label used by the cart summary.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return 'Cart';
    }
}
