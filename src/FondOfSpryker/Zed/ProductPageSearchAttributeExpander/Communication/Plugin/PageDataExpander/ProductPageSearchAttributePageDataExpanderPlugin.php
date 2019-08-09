<?php

declare(strict_types=1);

namespace FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\PageDataExpander;

use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

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
        $attributes = json_decode($productData['attributes'], true);

        $productAbstractPageSearchTransfer->setAttributes($attributes);
    }
}
