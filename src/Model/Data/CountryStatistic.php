<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class CountryStatistic
{
    public ?string $applicationId;
    public ?int $usage;

    public function __construct(array $args = [])
    {
        if (array_key_exists('applicationId', $args)) {
            $this->applicationId = $args['applicationId'];
        }
        if (array_key_exists('usage', $args)) {
            $this->usage = $args['usage'];
        }
    }
}