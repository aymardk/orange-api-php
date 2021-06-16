<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Response;

use Aymardkouakou\OrangeApiPhp\Model\Data\PurchaseOrder;

class PurchaseOrderResponse
{
    public ?array $purchaseOrders = [];

    public function __construct(array $args = [])
    {
        if (array_key_exists('purchaseOrders', $args)) {
            foreach ($args['purchaseOrders'] as $purchaseOrder) {
                $this->purchaseOrders[] = new PurchaseOrder($purchaseOrder);
            }
        }
    }
}