<?php

declare(strict_types = 1);

namespace FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearch;

use FondOfSpryker\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

/**
 * @method \FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Business\ProductPageSearchAttributeExpanderFacadeInterface getFacade()
 */
class ProductAttributePageDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderInterface
{
    /**
     * @param array $productPageData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return void
     */
    public function expandProductPageData(array $productPageData, ProductPageSearchTransfer $productAbstractPageSearchTransfer): void
    {
        $productPageData = $this->getFacade()
            ->expandProductPageData($productPageData, $productAbstractPageSearchTransfer);

        $attributes = $productPageData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES];

        $productAbstractPageSearchTransfer->setAttributes($attributes);
    }
}
