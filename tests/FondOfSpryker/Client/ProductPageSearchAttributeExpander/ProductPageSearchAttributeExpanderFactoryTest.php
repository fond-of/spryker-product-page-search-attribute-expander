<?php

namespace FondOfSpryker\Client\ProductPageSearchAttributeExpander;

use Codeception\Test\Unit;
use FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder\SearchConfigExtensionBuilder;

class ProductPageSearchAttributeExpanderFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfSpryker\Client\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderFactory
     */
    protected $productPageSearchAttributeExpanderFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->configMock = $this->getMockBuilder(ProductPageSearchAttributeExpanderConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productPageSearchAttributeExpanderFactory = new ProductPageSearchAttributeExpanderFactory();
        $this->productPageSearchAttributeExpanderFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateSearchConfigExtensionBuilder(): void
    {
        static::assertInstanceOf(
            SearchConfigExtensionBuilder::class,
            $this->productPageSearchAttributeExpanderFactory->createSearchConfigExtensionBuilder()
        );
    }
}
