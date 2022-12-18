<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardk\OrangeApiPhp\Model\Data\PurchaseOrder;

class PurchaseOrderResponse
{
    public ?array $purchaseOrders = [];

    public function __construct(array $args = [])
    {
        foreach ($args as $arg) {
            $this->purchaseOrders[] = new PurchaseOrder($arg);
        }
    }
}