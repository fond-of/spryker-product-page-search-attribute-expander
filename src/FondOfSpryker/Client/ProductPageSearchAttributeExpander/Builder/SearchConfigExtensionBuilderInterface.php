<?php

namespace FondOfSpryker\Client\ProductPageSearchAttributeExpander\Builder;

use Generated\Shared\Transfer\SearchConfigExtensionTransfer;

interface SearchConfigExtensionBuilderInterface
{
    /**
     * @return \Generated\Shared\Transfer\SearchConfigExtensionTransfer
     */
    public function build(): SearchConfigExtensionTransfer;
}
