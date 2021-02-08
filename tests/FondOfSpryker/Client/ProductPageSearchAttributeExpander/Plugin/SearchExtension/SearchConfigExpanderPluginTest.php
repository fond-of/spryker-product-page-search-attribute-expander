<?php

namespace FondOfSpryker\Client\ProductPageSearchAttributeExpander\Plugin\SearchExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilder;
use FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderFactory;
use Generated\Shared\Transfer\SearchConfigExtensionTransfer;

class SearchConfigExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $searchConfigExtensionBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\SearchConfigExtensionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $searchConfigExtensionTransferMock;

    /**
     * @var \FondOfSpryker\Client\ProductPageSearchAttributeExpander\Plugin\SearchExtension\SearchConfigExpanderPlugin
     */
    protected $searchConfigExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->factoryMock = $this->getMockBuilder(ProductPageSearchAttributeExpanderFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchConfigExtensionBuilderMock = $this->getMockBuilder(SearchConfigExtensionBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchConfigExtensionTransferMock = $this->getMockBuilder(SearchConfigExtensionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchConfigExpanderPlugin = new SearchConfigExpanderPlugin();
        $this->searchConfigExpanderPlugin->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testGetSearchConfigExtension(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createSearchConfigExtensionBuilder')
            ->willReturn($this->searchConfigExtensionBuilderMock);

        $this->searchConfigExtensionBuilderMock->expects(static::atLeastOnce())
            ->method('build')
            ->willReturn($this->searchConfigExtensionTransferMock);

        static::assertEquals(
            $this->searchConfigExtensionTransferMock,
            $this->searchConfigExpanderPlugin->getSearchConfigExtension()
        );
    }
}
