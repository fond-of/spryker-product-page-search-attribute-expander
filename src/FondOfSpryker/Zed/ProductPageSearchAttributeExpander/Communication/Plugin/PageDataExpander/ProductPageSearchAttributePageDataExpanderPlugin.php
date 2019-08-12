<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\PageDataExpander;

use FondOfSpryker\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

use function array_key_exists;
use function json_decode;

class ProductPageSearchAttributePageDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderInterface
{
    /**
     * @param array $productData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return void
     */
    public function expandProductPageData(array $productData, ProductPageSearchTransfer $productAbstractPageSearchTransfer): void
    {
        $abstractProductAttributes = [];
        if (array_key_exists(ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES, $productData)) {
            $abstractProductAttributes = json_decode($productData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES], true);
        }

        $productAbstractPageSearchTransfer->setAttributes($abstractProductAttributes);
    }
}
