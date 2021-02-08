<?php

namespace FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearch;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderSearchConfig;
use FondOfSpryker\Zed\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

class ProductAttributePageMapExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PageMapTransfer
     */
    protected $pageMapTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;
     */
    protected $pageMapBuilderMock;

    /**
     * @var array
     */
    protected $productData;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\LocaleTransfer
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfSpryker\Zed\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var string[]
     */
    protected $sortableIntegerAttributes;

    /**
     * @var string[]
     */
    protected $sortableStringAttributes;

    /**
     * @var \FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Communication\Plugin\ProductPageSearch\ProductAttributePageMapExpanderPlugin
     */
    protected $productAttributesMapExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->pageMapTransferMock = $this->getMockBuilder(PageMapTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageMapBuilderMock = $this->getMockBuilder(PageMapBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productData = [
            ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES => [
                'foo' => 1,
                'bar' => 'foo',
            ],
        ];

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(ProductPageSearchAttributeExpanderConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sortableIntegerAttributes = ['foo'];
        $this->sortableStringAttributes = ['bar'];

        $this->productAttributesMapExpanderPlugin = new ProductAttributePageMapExpanderPlugin();
        $this->productAttributesMapExpanderPlugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testExpandProductMap(): void
    {
        $this->pageMapBuilderMock->expects(static::atLeastOnce())
            ->method('addSearchResultData')
            ->with(
                $this->pageMapTransferMock,
                ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES,
                $this->productData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES]
            )->willReturn($this->productAttributesMapExpanderPlugin);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortableIntegerAttributes')
            ->willReturn($this->sortableIntegerAttributes);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortableStringAttributes')
            ->willReturn($this->sortableStringAttributes);

        $this->pageMapBuilderMock->expects(static::atLeastOnce())
            ->method('addIntegerSort')
            ->with(
                $this->pageMapTransferMock,
                $this->sortableIntegerAttributes[0],
                $this->productData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES][$this->sortableIntegerAttributes[0]]
            )->willReturn($this->productAttributesMapExpanderPlugin);

        $this->pageMapBuilderMock->expects(static::atLeastOnce())
            ->method('addStringSort')
            ->with(
                $this->pageMapTransferMock,
                $this->sortableStringAttributes[0],
                $this->productData[ProductPageSearchAttributeExpanderSearchConfig::KEY_PRODUCT_DATA_ATTRIBUTES][$this->sortableStringAttributes[0]]
            )->willReturn($this->productAttributesMapExpanderPlugin);

        static::assertEquals(
            $this->pageMapTransferMock,
            $this->productAttributesMapExpanderPlugin->expandProductPageMap(
                $this->pageMapTransferMock,
                $this->pageMapBuilderMock,
                $this->productData,
                $this->localeTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testExpandProductMapWithoutAttributes(): void
    {
        $this->pageMapBuilderMock->expects(static::never())
            ->method('addSearchResultData');

        $this->configMock->expects(static::never())
            ->method('getSortableIntegerAttributes');

        $this->configMock->expects(static::never())
            ->method('getSortableStringAttributes');

        $this->pageMapBuilderMock->expects(static::never())
            ->method('addIntegerSort');

        $this->pageMapBuilderMock->expects(static::never())
            ->method('addStringSort');

        static::assertEquals(
            $this->pageMapTransferMock,
            $this->productAttributesMapExpanderPlugin->expandProductPageMap(
                $this->pageMapTransferMock,
                $this->pageMapBuilderMock,
                [],
                $this->localeTransferMock
            )
        );
    }
}
