<?php

namespace FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder;

use FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig;
use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\SearchConfigExtensionTransfer;
use Generated\Shared\Transfer\SortConfigTransfer;

class SearchConfigExtensionBuilder implements SearchConfigExtensionBuilderInterface
{
    protected const PARAMETER_NAME_SUFFIX_ASC = '_asc';
    protected const PARAMETER_NAME_SUFFIX_DESC = '_desc';

    /**
     * @var \FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig
     */
    protected $config;

    /**
     * @param \FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig $config
     */
    public function __construct(ProductPageSearchAttributeExpanderConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Generated\Shared\Transfer\SearchConfigExtensionTransfer
     */
    public function build(): SearchConfigExtensionTransfer
    {
        $searchConfigExtensionTransfer = new SearchConfigExtensionTransfer();

        $searchConfigExtensionTransfer = $this->addIntegerSort($searchConfigExtensionTransfer);

        return $this->addStringSort($searchConfigExtensionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SearchConfigExtensionTransfer $searchConfigExtensionTransfer
     *
     * @return \Generated\Shared\Transfer\SearchConfigExtensionTransfer
     */
    protected function addIntegerSort(
        SearchConfigExtensionTransfer $searchConfigExtensionTransfer
    ): SearchConfigExtensionTransfer {
        $fieldName = PageIndexMap::INTEGER_SORT;

        foreach ($this->config->getSortableIntegerAttributes() as $sortableAttribute) {
            $searchConfigExtensionTransfer->addSortConfig(
                $this->createSortConfigTransfer($sortableAttribute, true, $fieldName)
            );

            $searchConfigExtensionTransfer->addSortConfig(
                $this->createSortConfigTransfer($sortableAttribute, false, $fieldName)
            );
        }

        return $searchConfigExtensionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\SearchConfigExtensionTransfer $searchConfigExtensionTransfer
     *
     * @return \Generated\Shared\Transfer\SearchConfigExtensionTransfer
     */
    protected function addStringSort(
        SearchConfigExtensionTransfer $searchConfigExtensionTransfer
    ): SearchConfigExtensionTransfer {
        $fieldName = PageIndexMap::STRING_SORT;

        foreach ($this->config->getSortableStringAttributes() as $sortableAttribute) {
            $searchConfigExtensionTransfer->addSortConfig(
                $this->createSortConfigTransfer($sortableAttribute, true, $fieldName)
            );

            $searchConfigExtensionTransfer->addSortConfig(
                $this->createSortConfigTransfer($sortableAttribute, false, $fieldName)
            );
        }

        return $searchConfigExtensionTransfer;
    }

    /**
     * @param string $name
     * @param bool $isDescending
     * @param string $fieldName
     *
     * @return \Generated\Shared\Transfer\SortConfigTransfer
     */
    protected function createSortConfigTransfer(
        string $name,
        bool $isDescending,
        string $fieldName
    ): SortConfigTransfer {
        $parameterNameSuffix = $isDescending ? static::PARAMETER_NAME_SUFFIX_DESC : static::PARAMETER_NAME_SUFFIX_ASC;
        $parameterName = sprintf('%s%s', $name, $parameterNameSuffix);

        return (new SortConfigTransfer())
            ->setName($name)
            ->setIsDescending($isDescending)
            ->setParameterName($parameterName)
            ->setFieldName($fieldName);
    }
}
