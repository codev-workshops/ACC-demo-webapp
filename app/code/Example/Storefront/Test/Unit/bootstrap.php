<?php
/**
 * Copyright © Example Co. All rights reserved.
 *
 * Test bootstrap: loads Composer autoloader then defines minimal Magento
 * framework stubs so unit tests can mock framework classes without
 * requiring magento/framework as a dependency.
 */

declare(strict_types=1);

require_once __DIR__ . '/../../../../../../vendor/autoload.php';

/*
 * ---------------------------------------------------------------
 * Magento Framework Stubs
 * ---------------------------------------------------------------
 * Only the signatures that our code and tests reference are
 * declared here. They are intentionally empty — PHPUnit will
 * create mock objects from them.
 * ---------------------------------------------------------------
 */

// --- Model layer -----------------------------------------------------------

// phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses
// phpcs:disable Squiz.Classes.ClassFileName.NoMatch
// phpcs:disable Magento2.PHP.FinalImplementation

if (!class_exists(\Magento\Framework\Model\AbstractModel::class)) {
    // @codingStandardsIgnoreStart
    /**
     * Stub for Magento\Framework\Model\AbstractModel.
     */
    class MagentoFrameworkModelAbstractModel
    {
        /**
         * Stub _init.
         *
         * @param string $resourceModel
         * @return void
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        protected function _init(string $resourceModel): void
        {
        }

        /**
         * Stub _construct.
         *
         * @return void
         */
        protected function _construct(): void
        {
        }

        /**
         * Stub getData.
         *
         * @param string $key
         * @return mixed
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function getData(string $key = '')
        {
            return null;
        }

        /**
         * Stub setData.
         *
         * @param string|array $key
         * @param mixed $value
         * @return $this
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function setData($key, $value = null)
        {
            return $this;
        }
    }
    class_alias('MagentoFrameworkModelAbstractModel', 'Magento\Framework\Model\AbstractModel');
    // @codingStandardsIgnoreEnd
}

// --- Resource model layer --------------------------------------------------

if (!class_exists(\Magento\Framework\Model\ResourceModel\Db\AbstractDb::class)) {
    /**
     * Stub for Magento\Framework\Model\ResourceModel\Db\AbstractDb.
     */
    class MagentoFrameworkModelResourceModelDbAbstractDb
    {
        /**
         * Stub _init.
         *
         * @param string $mainTable
         * @param string $idFieldName
         * @return void
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        protected function _init(string $mainTable, string $idFieldName): void
        {
        }

        /**
         * Stub _construct.
         *
         * @return void
         */
        protected function _construct(): void
        {
        }

        /**
         * Stub load.
         *
         * @param \Magento\Framework\Model\AbstractModel $object
         * @param mixed $value
         * @param string|null $field
         * @return $this
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function load(
            \Magento\Framework\Model\AbstractModel $object,
            $value,
            $field = null
        ) {
            return $this;
        }

        /**
         * Stub save.
         *
         * @param \Magento\Framework\Model\AbstractModel $object
         * @return $this
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function save(\Magento\Framework\Model\AbstractModel $object)
        {
            return $this;
        }

        /**
         * Stub delete.
         *
         * @param \Magento\Framework\Model\AbstractModel $object
         * @return $this
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function delete(\Magento\Framework\Model\AbstractModel $object)
        {
            return $this;
        }
    }
    class_alias(
        'MagentoFrameworkModelResourceModelDbAbstractDb',
        'Magento\Framework\Model\ResourceModel\Db\AbstractDb'
    );
}

// --- Collection layer ------------------------------------------------------

if (!class_exists(
    \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection::class
)) {
    /**
     * Stub for AbstractCollection.
     */
    class MagentoFrameworkCollectionAbstractCollection
    {
        /**
         * Stub _init.
         *
         * @param string $model
         * @param string $resourceModel
         * @return void
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        protected function _init(string $model, string $resourceModel): void
        {
        }

        /**
         * Stub _construct.
         *
         * @return void
         */
        protected function _construct(): void
        {
        }

        /**
         * Stub getItems.
         *
         * @return array
         */
        public function getItems(): array
        {
            return [];
        }

        /**
         * Stub getSize.
         *
         * @return int
         */
        public function getSize(): int
        {
            return 0;
        }
    }
    class_alias(
        'MagentoFrameworkCollectionAbstractCollection',
        'Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection'
    );
}

// --- API / Search layer ----------------------------------------------------

if (!interface_exists(\Magento\Framework\Api\SearchResultsInterface::class)) {
    /**
     * Stub for SearchResultsInterface.
     */
    interface MagentoFrameworkApiSearchResultsInterface
    {
        /**
         * Get items.
         *
         * @return array
         */
        public function getItems(): array;

        /**
         * Set items.
         *
         * @param array $items
         * @return $this
         */
        public function setItems(array $items);

        /**
         * Get search criteria.
         *
         * @return \Magento\Framework\Api\SearchCriteriaInterface
         */
        public function getSearchCriteria();

        /**
         * Set search criteria.
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         * @return $this
         */
        public function setSearchCriteria(
            \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
        );

        /**
         * Get total count.
         *
         * @return int
         */
        public function getTotalCount(): int;

        /**
         * Set total count.
         *
         * @param int $totalCount
         * @return $this
         */
        public function setTotalCount(int $totalCount);
    }
    class_alias(
        'MagentoFrameworkApiSearchResultsInterface',
        'Magento\Framework\Api\SearchResultsInterface'
    );
}

if (!interface_exists(\Magento\Framework\Api\SearchCriteriaInterface::class)) {
    /**
     * Stub for SearchCriteriaInterface.
     */
    interface MagentoFrameworkApiSearchCriteriaInterface
    {
    }
    class_alias(
        'MagentoFrameworkApiSearchCriteriaInterface',
        'Magento\Framework\Api\SearchCriteriaInterface'
    );
}

if (!class_exists(\Magento\Framework\Api\SearchCriteriaBuilder::class)) {
    /**
     * Stub for SearchCriteriaBuilder.
     */
    class MagentoFrameworkApiSearchCriteriaBuilder
    {
        /**
         * Add filter.
         *
         * @param string $field
         * @param mixed $value
         * @param string $conditionType
         * @return $this
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function addFilter(
            string $field,
            $value,
            string $conditionType = 'eq'
        ) {
            return $this;
        }

        /**
         * Add sort order.
         *
         * @param \Magento\Framework\Api\SortOrder $sortOrder
         * @return $this
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function addSortOrder(\Magento\Framework\Api\SortOrder $sortOrder)
        {
            return $this;
        }

        /**
         * Create search criteria.
         *
         * @return \Magento\Framework\Api\SearchCriteriaInterface
         */
        public function create()
        {
            return new class implements \Magento\Framework\Api\SearchCriteriaInterface {
            };
        }
    }
    class_alias(
        'MagentoFrameworkApiSearchCriteriaBuilder',
        'Magento\Framework\Api\SearchCriteriaBuilder'
    );
}

if (!class_exists(\Magento\Framework\Api\SortOrder::class)) {
    /**
     * Stub for SortOrder.
     */
    class MagentoFrameworkApiSortOrder
    {
    }
    class_alias(
        'MagentoFrameworkApiSortOrder',
        'Magento\Framework\Api\SortOrder'
    );
}

if (!class_exists(\Magento\Framework\Api\SortOrderBuilder::class)) {
    /**
     * Stub for SortOrderBuilder.
     */
    class MagentoFrameworkApiSortOrderBuilder
    {
        /**
         * Set field.
         *
         * @param string $field
         * @return $this
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function setField(string $field)
        {
            return $this;
        }

        /**
         * Set ascending direction.
         *
         * @return $this
         */
        public function setAscendingDirection()
        {
            return $this;
        }

        /**
         * Create sort order.
         *
         * @return \Magento\Framework\Api\SortOrder
         */
        public function create()
        {
            return new \Magento\Framework\Api\SortOrder();
        }
    }
    class_alias(
        'MagentoFrameworkApiSortOrderBuilder',
        'Magento\Framework\Api\SortOrderBuilder'
    );
}

if (!interface_exists(
    \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface::class
)) {
    /**
     * Stub for CollectionProcessorInterface.
     */
    interface MagentoFrameworkApiCollectionProcessorInterface
    {
        /**
         * Process.
         *
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         * @param mixed $collection
         * @return void
         */
        public function process(
            \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria,
            $collection
        ): void;
    }
    class_alias(
        'MagentoFrameworkApiCollectionProcessorInterface',
        'Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface'
    );
}

// --- Exception layer -------------------------------------------------------

if (!class_exists(\Magento\Framework\Exception\LocalizedException::class)) {
    /**
     * Stub for LocalizedException.
     */
    class MagentoFrameworkExceptionLocalizedException extends \Exception
    {
        /**
         * Constructor.
         *
         * @param \Magento\Framework\Phrase|string $phrase
         * @param \Exception|null $cause
         * @param int $code
         */
        public function __construct($phrase = '', ?\Exception $cause = null, int $code = 0)
        {
            parent::__construct((string) $phrase, $code, $cause);
        }
    }
    class_alias(
        'MagentoFrameworkExceptionLocalizedException',
        'Magento\Framework\Exception\LocalizedException'
    );
}

if (!class_exists(\Magento\Framework\Exception\NoSuchEntityException::class)) {
    /**
     * Stub for NoSuchEntityException.
     */
    class MagentoFrameworkExceptionNoSuchEntityException extends
        \Magento\Framework\Exception\LocalizedException
    {
    }
    class_alias(
        'MagentoFrameworkExceptionNoSuchEntityException',
        'Magento\Framework\Exception\NoSuchEntityException'
    );
}

if (!class_exists(\Magento\Framework\Exception\CouldNotSaveException::class)) {
    /**
     * Stub for CouldNotSaveException.
     */
    class MagentoFrameworkExceptionCouldNotSaveException extends
        \Magento\Framework\Exception\LocalizedException
    {
    }
    class_alias(
        'MagentoFrameworkExceptionCouldNotSaveException',
        'Magento\Framework\Exception\CouldNotSaveException'
    );
}

if (!class_exists(\Magento\Framework\Exception\CouldNotDeleteException::class)) {
    /**
     * Stub for CouldNotDeleteException.
     */
    class MagentoFrameworkExceptionCouldNotDeleteException extends
        \Magento\Framework\Exception\LocalizedException
    {
    }
    class_alias(
        'MagentoFrameworkExceptionCouldNotDeleteException',
        'Magento\Framework\Exception\CouldNotDeleteException'
    );
}

// --- Setup layer -----------------------------------------------------------

if (!interface_exists(\Magento\Framework\Setup\ModuleDataSetupInterface::class)) {
    /**
     * Stub for ModuleDataSetupInterface.
     */
    interface MagentoFrameworkSetupModuleDataSetupInterface
    {
        /**
         * Get connection.
         *
         * @return \Magento\Framework\DB\Adapter\AdapterInterface
         */
        public function getConnection();

        /**
         * Get table name.
         *
         * @param string $tableName
         * @return string
         */
        public function getTable(string $tableName): string;
    }
    class_alias(
        'MagentoFrameworkSetupModuleDataSetupInterface',
        'Magento\Framework\Setup\ModuleDataSetupInterface'
    );
}

if (!interface_exists(\Magento\Framework\Setup\Patch\DataPatchInterface::class)) {
    /**
     * Stub for DataPatchInterface.
     */
    interface MagentoFrameworkSetupPatchDataPatchInterface
    {
        /**
         * Apply.
         *
         * @return void
         */
        public function apply(): void;

        /**
         * Get dependencies.
         *
         * @return array
         */
        public static function getDependencies(): array;

        /**
         * Get aliases.
         *
         * @return array
         */
        public function getAliases(): array;
    }
    class_alias(
        'MagentoFrameworkSetupPatchDataPatchInterface',
        'Magento\Framework\Setup\Patch\DataPatchInterface'
    );
}

if (!interface_exists(\Magento\Framework\DB\Adapter\AdapterInterface::class)) {
    /**
     * Stub for AdapterInterface.
     */
    interface MagentoFrameworkDBAdapterAdapterInterface
    {
        /**
         * Insert.
         *
         * @param string $table
         * @param array $bind
         * @return int
         */
        public function insert(string $table, array $bind): int;
    }
    class_alias(
        'MagentoFrameworkDBAdapterAdapterInterface',
        'Magento\Framework\DB\Adapter\AdapterInterface'
    );
}

// --- View layer ------------------------------------------------------------

if (!interface_exists(
    \Magento\Framework\View\Element\Block\ArgumentInterface::class
)) {
    /**
     * Stub for ArgumentInterface.
     */
    interface MagentoFrameworkViewElementBlockArgumentInterface
    {
    }
    class_alias(
        'MagentoFrameworkViewElementBlockArgumentInterface',
        'Magento\Framework\View\Element\Block\ArgumentInterface'
    );
}

// --- Component registrar ---------------------------------------------------

if (!class_exists(\Magento\Framework\Component\ComponentRegistrar::class)) {
    /**
     * Stub for ComponentRegistrar.
     */
    class MagentoFrameworkComponentComponentRegistrar
    {
        public const MODULE = 'module';
        public const THEME  = 'theme';

        /**
         * Register.
         *
         * @param string $type
         * @param string $componentName
         * @param string $path
         * @return void
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public static function register(
            string $type,
            string $componentName,
            string $path
        ): void {
        }
    }
    class_alias(
        'MagentoFrameworkComponentComponentRegistrar',
        'Magento\Framework\Component\ComponentRegistrar'
    );
}

// --- Auto-generated factory stubs ------------------------------------------

if (!class_exists(\Example\Storefront\Model\BannerFactory::class)) {
    /**
     * Stub for auto-generated BannerFactory.
     */
    class ExampleStorefrontModelBannerFactory
    {
        /**
         * Create a new Banner instance.
         *
         * @param array $data
         * @return \Example\Storefront\Model\Banner
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function create(array $data = [])
        {
            return new \Example\Storefront\Model\Banner();
        }
    }
    class_alias(
        'ExampleStorefrontModelBannerFactory',
        'Example\Storefront\Model\BannerFactory'
    );
}

if (!class_exists(
    \Example\Storefront\Model\ResourceModel\Banner\CollectionFactory::class
)) {
    /**
     * Stub for auto-generated CollectionFactory.
     */
    class ExampleStorefrontModelResourceModelBannerCollectionFactory
    {
        /**
         * Create a new Collection instance.
         *
         * @param array $data
         * @return \Example\Storefront\Model\ResourceModel\Banner\Collection
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function create(array $data = [])
        {
            return new \Example\Storefront\Model\ResourceModel\Banner\Collection();
        }
    }
    class_alias(
        'ExampleStorefrontModelResourceModelBannerCollectionFactory',
        'Example\Storefront\Model\ResourceModel\Banner\CollectionFactory'
    );
}

if (!class_exists(
    \Example\Storefront\Api\Data\BannerSearchResultsInterfaceFactory::class
)) {
    /**
     * Stub for auto-generated BannerSearchResultsInterfaceFactory.
     */
    class ExampleStorefrontApiDataBannerSearchResultsInterfaceFactory
    {
        /**
         * Create a new search results instance.
         *
         * @param array $data
         * @return \Example\Storefront\Api\Data\BannerSearchResultsInterface
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function create(array $data = [])
        {
            return null;
        }
    }
    class_alias(
        'ExampleStorefrontApiDataBannerSearchResultsInterfaceFactory',
        'Example\Storefront\Api\Data\BannerSearchResultsInterfaceFactory'
    );
}

// --- Phrase -----------------------------------------------------------------

if (!class_exists(\Magento\Framework\Phrase::class)) {
    /**
     * Stub for Phrase.
     */
    class MagentoFrameworkPhrase
    {
        /**
         * @var string
         */
        private string $text;

        /**
         * @param string $text
         * @param array $arguments
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function __construct(string $text = '', array $arguments = [])
        {
            $this->text = $text;
        }

        /**
         * To string.
         *
         * @return string
         */
        public function __toString(): string
        {
            return $this->text;
        }
    }
    class_alias('MagentoFrameworkPhrase', 'Magento\Framework\Phrase');
}

/**
 * Magento's __() helper — returns a Phrase object.
 *
 * @return \Magento\Framework\Phrase
 */
if (!function_exists('__')) {
    /**
     * Translation stub.
     *
     * @param string $text
     * @param mixed ...$args
     * @return \Magento\Framework\Phrase
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    function __(string $text, ...$args): \Magento\Framework\Phrase
    {
        return new \Magento\Framework\Phrase($text, $args);
    }
}
