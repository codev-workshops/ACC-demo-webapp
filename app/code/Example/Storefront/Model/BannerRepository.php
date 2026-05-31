<?php
/**
 * Copyright © Example Co. All rights reserved.
 */

declare(strict_types=1);

namespace Example\Storefront\Model;

use Example\Storefront\Api\BannerRepositoryInterface;
use Example\Storefront\Api\Data\BannerInterface;
use Example\Storefront\Api\Data\BannerSearchResultsInterface;
use Example\Storefront\Api\Data\BannerSearchResultsInterfaceFactory;
use Example\Storefront\Model\ResourceModel\Banner as BannerResource;
use Example\Storefront\Model\ResourceModel\Banner\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Repository implementation for banner entities.
 */
class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var BannerResource
     */
    private BannerResource $resource;

    /**
     * @var BannerFactory
     */
    private BannerFactory $bannerFactory;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var BannerSearchResultsInterfaceFactory
     */
    private BannerSearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @param BannerResource $resource
     * @param BannerFactory $bannerFactory
     * @param CollectionFactory $collectionFactory
     * @param BannerSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        BannerResource $resource,
        BannerFactory $bannerFactory,
        CollectionFactory $collectionFactory,
        BannerSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->bannerFactory = $bannerFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $bannerId): BannerInterface
    {
        $banner = $this->bannerFactory->create();
        $this->resource->load($banner, $bannerId);

        if (!$banner->getBannerId()) {
            throw new NoSuchEntityException(
                __('Banner with ID "%1" does not exist.', $bannerId)
            );
        }

        return $banner;
    }

    /**
     * @inheritDoc
     */
    public function save(BannerInterface $banner): BannerInterface
    {
        try {
            /** @var Banner $banner */
            $this->resource->save($banner);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the banner: %1', $exception->getMessage()),
                $exception
            );
        }

        return $banner;
    }

    /**
     * @inheritDoc
     */
    public function delete(BannerInterface $banner): bool
    {
        try {
            /** @var Banner $banner */
            $this->resource->delete($banner);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the banner: %1', $exception->getMessage()),
                $exception
            );
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    ): BannerSearchResultsInterface {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
