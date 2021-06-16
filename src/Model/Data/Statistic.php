<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class Statistic
{
    public ?string $service;
    public ?array $serviceStatistics = [];

    public function __construct(array $args = [])
    {
        if (array_key_exists('service', $args)) {
            $this->service = $args['service'];
        }
        if (array_key_exists('serviceStatistics', $args)) {
            foreach ($args['serviceStatistics'] as $serviceStatistic) {
                $this->serviceStatistics[] = new ServiceStatistic($serviceStatistic);
            }
        }
    }
}