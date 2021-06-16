<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class Contract
{
    public ?string $service;
    public ?string $contractDescription;
    public ?array $serviceContracts = [];

    public function __construct(array $args = [])
    {
        if (array_key_exists('service', $args)) {
            $this->service = $args['service'];
        }
        if (array_key_exists('contractDescription', $args)) {
            $this->contractDescription = $args['contractDescription'];
        }
        if (array_key_exists('serviceContracts', $args)) {
            foreach ($args['serviceContracts'] as $sc) {
                $this->serviceContracts[] = new ServiceContract($sc);
            }
        }
    }
}