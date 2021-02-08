<?php

namespace FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig;

class SearchConfigExtensionBuilderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilder
     */
    protected $searchConfigExtensionBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(ProductPageSearchAttributeExpanderConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->sortableIntegerAttributes = ['foo'];
        $this->sortableStringAttributes = ['bar'];

        $this->searchConfigExtensionBuilder = new SearchConfigExtensionBuilder($this->configMock);
    }

    /**
     * @return void
     */
    public function testBuild(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortableIntegerAttributes')
            ->willReturn($this->sortableIntegerAttributes);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortableStringAttributes')
            ->willReturn($this->sortableStringAttributes);

        $searchConfigExtensionTransfer = $this->searchConfigExtensionBuilder->build();

        static::assertCount(4, $searchConfigExtensionTransfer->getSortConfigs());
    }
}
