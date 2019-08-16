<?php

namespace FondOfSpryker\Zed\ProductPageSearchAttributeExpander\Dependency\Facade;

interface ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface
{
    /**
     * @param int $idProductAbstract
     *
     * @return array
     */
    public function getProductAbstractAttributeValues(int $idProductAbstract): array;
}
