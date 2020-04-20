<?php

namespace FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearchExtension;

use FondOfSpryker\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractMapExpanderPluginInterface;

/**
 * @method \FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Business\ProductPageSearchAttributeExpanderFacadeInterface getFacade()
 */
class ProductAttributePageMapExpanderPlugin extends AbstractPlugin implements ProductAbstractMapExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return void
     */
    public function expandProductMap(
        PageMapTransfer $pageMapTransfer,
        PageMapBuilderInterface $pageMapBuilder,
        array $productData,
        LocaleTransfer $localeTransfer
    ) {
        $productDataKey = ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES;
        $abstractProductAttributes = [];

        if (array_key_exists($productDataKey, $productData)) {
            $abstractProductAttributes = $productData[$productDataKey];
        }

        $pageMapBuilder->addSearchResultData(
            $pageMapTransfer,
            ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES,
            $abstractProductAttributes
        );
    }
}
