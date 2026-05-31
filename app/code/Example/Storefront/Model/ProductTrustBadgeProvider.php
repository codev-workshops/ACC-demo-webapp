<?php
/**
 * Copyright © Example Co. All rights reserved.
 */

declare(strict_types=1);

namespace Example\Storefront\Model;

use Example\Storefront\Api\ProductTrustBadgeProviderInterface;

/**
 * Alternate trust badge provider (placeholder).
 */
class ProductTrustBadgeProvider implements ProductTrustBadgeProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return 'Quality checked and ready to ship.';
    }

    /**
     * @inheritDoc
     */
    public function isEnabled(): bool
    {
        return true;
    }
}
