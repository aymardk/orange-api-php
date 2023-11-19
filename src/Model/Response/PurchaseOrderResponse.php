<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardk\OrangeApiPhp\Model\Data\PurchaseOrderData;

class PurchaseOrderResponse
{
    private ?array $purchaseOrders;

    public function __construct(array $args = [])
    {
        $this->purchaseOrders = [];

        foreach ($args as $arg) {
            $this->purchaseOrders[] = new PurchaseOrderData($arg);
        }
    }

    /**
     * @return array|null
     */
    public function getPurchaseOrders(): ?array
    {
        return $this->purchaseOrders;
    }

}