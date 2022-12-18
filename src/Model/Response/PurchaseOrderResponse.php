<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Response;

use Aymardkouakou\OrangeApiPhp\Model\Data\PurchaseOrder;

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