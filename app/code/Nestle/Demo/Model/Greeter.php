<?php
/**
 * Copyright © Nestlé S.A. All rights reserved.
 */

declare(strict_types=1);

namespace Nestle\Demo\Model;

use Nestle\Demo\Api\GreeterInterface;
use Psr\Log\LoggerInterface;

/**
 * Default greeting builder for the Nestlé storefront.
 */
class Greeter implements GreeterInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function getGreeting(string $customerName): string
    {
        $name = trim($customerName);
        if ($name === '') {
            $name = 'Guest';
        }

        $this->logger->info(sprintf('Nestlé greeting generated for "%s".', $name));

        return sprintf('Welcome to Nestlé, %s!', $name);
    }
}
