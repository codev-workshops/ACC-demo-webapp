<?php
/**
 * Copyright © Nestlé S.A. All rights reserved.
 */

declare(strict_types=1);

namespace Nestle\Demo\Api;

/**
 * Service contract for building localized storefront greetings.
 *
 * @api
 */
interface GreeterInterface
{
    /**
     * Build a personalized welcome greeting for the given customer name.
     *
     * @param string $customerName
     * @return string
     */
    public function getGreeting(string $customerName): string;
}
