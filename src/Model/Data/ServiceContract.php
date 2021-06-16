<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class ServiceContract
{
    public ?string $country;
    public ?string $service;
    public ?int $availableUnits;
    public ?string $expires;
    public ?string $scDescription;

    public function __construct(array $args = [])
    {
        if (array_key_exists('country', $args)) {
            $this->country = $args['country'];
        }
        if (array_key_exists('service', $args)) {
            $this->service = $args['service'];
        }
        if (array_key_exists('availableUnits', $args)) {
            $this->availableUnits = $args['availableUnits'];
        }
        if (array_key_exists('expires', $args)) {
            $this->expires = $args['expires'];
        }
        if (array_key_exists('scDescription', $args)) {
            $this->scDescription = $args['scDescription'];
        }
    }
}