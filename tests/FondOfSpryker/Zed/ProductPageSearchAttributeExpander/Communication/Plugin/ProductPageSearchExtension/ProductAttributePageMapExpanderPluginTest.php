<?php

namespace FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearchExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;

class ProductAttributePageMapExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearchExtension\ProductAttributePageMapExpanderPlugin
     */
    protected $productAttributesMapExpanderPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PageMapTransfer
     */
    protected $pageMapTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface
     */
    protected $pageMapBuilderInterfaceMock;

    /**
     * @var array
     */
    protected $productData;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->pageMapTransferMock = $this->getMockBuilder(PageMapTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageMapBuilderInterfaceMock = $this->getMockBuilder(PageMapBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productData = [
            ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES => [],
        ];

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAttributesMapExpanderPlugin = new ProductAttributePageMapExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandProductMap(): void
    {
        $this->pageMapBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('addSearchResultData')
            ->with(
                $this->pageMapTransferMock,
                ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES,
                $this->productData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES]
            )->willReturn($this->productAttributesMapExpanderPlugin);

        $this->productAttributesMapExpanderPlugin->expandProductMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderInterfaceMock,
            $this->productData,
            $this->localeTransferMock
        );
    }

    /**
     * @return void
     */
    public function testExpandProductMapNoProductBrand(): void
    {
        $this->pageMapBuilderInterfaceMock->expects($this->atLeastOnce())
            ->method('addSearchResultData')
            ->with(
                $this->pageMapTransferMock,
                ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES,
                []
            )->willReturn($this->productAttributesMapExpanderPlugin);

        $this->productAttributesMapExpanderPlugin->expandProductMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderInterfaceMock,
            [],
            $this->localeTransferMock
        );
    }
}
