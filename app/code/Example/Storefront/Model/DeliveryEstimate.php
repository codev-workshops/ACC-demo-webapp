<?php
/**
 * Copyright © Example Co. All rights reserved.
 */

declare(strict_types=1);

namespace Example\Storefront\Model;

use Example\Storefront\Api\DeliveryEstimateInterface;
use Psr\Log\LoggerInterface;

/**
 * Default delivery estimate provider for the storefront.
 *
 * For this first version the estimate is based on the number of business days
 * (Monday–Friday) between today and the projected delivery date.
 */
class DeliveryEstimate implements DeliveryEstimateInterface
{
    /**
     * Number of business days the warehouse needs to dispatch and deliver.
     */
    private const DEFAULT_LEAD_DAYS = 5;

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
    public function getEstimate(string $sku): int
    {
        $businessDays = $this->countBusinessDays(self::DEFAULT_LEAD_DAYS);

        $this->logger->info(
            sprintf('Delivery estimate for SKU "%s": %d business day(s).', $sku, $businessDays)
        );

        return $businessDays;
    }

    /**
     * Count the business days (Monday–Friday) within the given lead window.
     *
     * @param int $leadDays
     * @return int
     */
    private function countBusinessDays(int $leadDays): int
    {
        $businessDays = 0;
        $cursor = new \DateTimeImmutable('today');

        for ($offset = 1; $offset <= $leadDays; $offset++) {
            $cursor = $cursor->modify('+1 day');
            $weekday = (int) $cursor->format('N');
            if ($weekday < 6) {
                $businessDays++;
            }
        }

        return $businessDays;
    }
}
