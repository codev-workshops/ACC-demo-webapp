<?php
/**
 * Copyright © Example Co. All rights reserved.
 */

declare(strict_types=1);

namespace Example\Storefront\Model;

use Example\Storefront\Api\GreeterInterface;
use Psr\Log\LoggerInterface;

/**
 * Default greeting builder for the storefront.
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

        $this->logger->info(sprintf('Greeting generated for "%s".', $name));

        return sprintf('Welcome, %s!', $name);
    }
}
