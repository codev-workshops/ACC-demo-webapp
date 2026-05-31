<?php
/**
 * Copyright © Example Co. All rights reserved.
 */

declare(strict_types=1);

namespace Example\Storefront\Api;

/**
 * Service contract for the storefront checkout message.
 *
 * @api
 */
interface CheckoutMessageInterface
{
    /**
     * Build the checkout summary message.
     *
     * @return string
     */
    public function getMessage(): string;
}
