<?php
/**
 * Copyright © Example Co. All rights reserved.
 */

declare(strict_types=1);

namespace Example\Storefront\ViewModel;

use Example\Storefront\Api\BannerRepositoryInterface;
use Example\Storefront\Api\Data\BannerInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * ViewModel that provides active hero banners to the template.
 */
class HeroBannerViewModel implements ArgumentInterface
{
    /**
     * @var BannerRepositoryInterface
     */
    private BannerRepositoryInterface $bannerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    private SortOrderBuilder $sortOrderBuilder;

    /**
     * @param BannerRepositoryInterface $bannerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     */
    public function __construct(
        BannerRepositoryInterface $bannerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * Retrieve active banners sorted by sort order ascending.
     *
     * @return BannerInterface[]
     */
    public function getActiveBanners(): array
    {
        $sortOrder = $this->sortOrderBuilder
            ->setField(BannerInterface::SORT_ORDER)
            ->setAscendingDirection()
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(BannerInterface::IS_ACTIVE, 1)
            ->addSortOrder($sortOrder)
            ->create();

        return $this->bannerRepository->getList($searchCriteria)->getItems();
    }
}
