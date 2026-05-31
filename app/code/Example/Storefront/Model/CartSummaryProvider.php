<?php
/**
 * Copyright © Example Co. All rights reserved.
 */

declare(strict_types=1);

namespace Example\Storefront\Model;

/**
 * Provides a short cart summary line for the checkout message.
 */
class CartSummaryProvider
{
    /**
     * @param CheckoutMessageBuilder $checkoutMessageBuilder
     */
    public function __construct(private readonly CheckoutMessageBuilder $checkoutMessageBuilder)
    {
    }

    /**
     * Build the cart summary line.
     *
     * @return string
     */
    public function getSummaryLine(): string
    {
        return sprintf('%s summary ready', $this->checkoutMessageBuilder->getLabel());
    }
}
