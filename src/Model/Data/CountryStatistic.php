<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class CountryStatistic
{
    public ?string $appid;
    public ?string $applicationId;
    public ?int $usage;
    public ?int $nbEnforcements;

    public function __construct(array $args = [])
    {
        if (array_key_exists('appid', $args)) {
            $this->appid = $args['appid'];
        }
        if (array_key_exists('applicationId', $args)) {
            $this->applicationId = $args['applicationId'];
        }
        if (array_key_exists('nbEnforcements', $args)) {
            $this->nbEnforcements = $args['nbEnforcements'];
        }
        if (array_key_exists('usage', $args)) {
            $this->usage = $args['usage'];
        }
    }
}