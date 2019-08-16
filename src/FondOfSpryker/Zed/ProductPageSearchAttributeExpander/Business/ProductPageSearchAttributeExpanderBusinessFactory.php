<?php

namespace FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Business;

use FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Business\Model\ProductPageDataExpander;
use FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Business\Model\ProductPageDataExpanderInterface;
use FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Dependency\Facade\ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface;
use FondOfSpryker\Zed\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ProductPageSearchAttributeExpanderBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Business\Model\ProductPageDataExpanderInterface
     */
    public function createProductPageDataExpander(): ProductPageDataExpanderInterface
    {
        return new ProductPageDataExpander($this->getProductAttributeFacade());
    }

    /**
     * @throws
     *
     * @return \FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Dependency\Facade\ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface
     */
    protected function getProductAttributeFacade(): ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface
    {
        return $this->getProvidedDependency(ProductPageSearchAttributeExpanderDependencyProvider::FACADE_PRODUCT_ATTRIBUTE);
    }
}
