<?php

namespace FondOfSpryker\Client\ProductPageSearchAttributeExpander;

use FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilder;
use FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilderInterface;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig getConfig()
 */
class ProductPageSearchAttributeExpanderFactory extends AbstractFactory
{
    /**
     * @return \FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilderInterface
     */
    public function createSearchConfigExtensionBuilder(): SearchConfigExtensionBuilderInterface
    {
        return new SearchConfigExtensionBuilder($this->getConfig());
    }
}
