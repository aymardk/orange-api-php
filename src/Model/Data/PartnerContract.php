<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class PartnerContract
{
    public ?string $partnerId;
    public ?array $contracts = [];

    public function __construct(array $args = [])
    {
        if (array_key_exists('partnerId', $args)) {
            $this->partnerId = $args['partnerId'];
        }
        if (array_key_exists('contracts', $args)) {
            foreach ($args['contracts'] as $contract) {
                $this->contracts[] = new Contract($contract);
            }
        }
    }
}