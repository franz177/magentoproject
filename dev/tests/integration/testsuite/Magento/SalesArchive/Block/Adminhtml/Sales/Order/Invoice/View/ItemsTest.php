<?php
/***
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\SalesArchive\Block\Adminhtml\Sales\Order\Invoice\View;

use Magento\Sales\Block\Adminhtml\Order\Invoice\View\Items;
use Magento\SalesArchive\Block\Adminhtml\Sales\Order\AbstractItemsTest;

/**
 * Class to test Invoice items block
 * @magentoAppArea adminhtml
 */
class ItemsTest extends AbstractItemsTest
{
    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->key = 'current_invoice';
        $this->block = $this->layout->createBlock(Items::class);
    }

    /**
     * @magentoDbIsolation enabled
     * @magentoDataFixture Magento/SalesArchive/_files/archived_order_with_invoice_shipment_creditmemo.php
     * @return void
     */
    public function testItemsAvailableOnPage(): void
    {
        $collection = $this->orderFactory->create()
            ->loadByIncrementId('100000111')
            ->getInvoiceCollection();
        $this->assertCount(1, $collection);
        $this->registerItem($collection->getFirstItem());
        $this->assertCount(1, $this->block->getInvoice()->getAllItems());
    }
}
