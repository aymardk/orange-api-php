<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class PurchaseOrder
{
    public ?string $purchaseOrderId;
    public ?string $mode;
    public ?string $bundleId;
    public ?string $bundleDescription;
    public ?string $partnerId;
    public ?array $inputs = [];
    public ?OrderExecutionInformation $orderExecutioninformation;

    public function __construct(array $args = [])
    {
        if (array_key_exists('purchaseOrderId', $args)) {
            $this->purchaseOrderId = $args['purchaseOrderId'];
        }
        if (array_key_exists('mode', $args)) {
            $this->mode = $args['mode'];
        }
        if (array_key_exists('bundleId', $args)) {
            $this->bundleId = $args['bundleId'];
        }
        if (array_key_exists('bundleDescription', $args)) {
            $this->bundleDescription = $args['bundleDescription'];
        }
        if (array_key_exists('partnerId', $args)) {
            $this->partnerId = $args['partnerId'];
        }
        if (array_key_exists('inputs', $args)) {
            foreach ($args['inputs'] as $input) {
                $this->inputs[] = new OrderInput($input);
            }
        }
        if (array_key_exists('orderExecutioninformation', $args)) {
            $this->orderExecutioninformation = new OrderExecutionInformation($args['orderExecutioninformation']);
        }
    }
}