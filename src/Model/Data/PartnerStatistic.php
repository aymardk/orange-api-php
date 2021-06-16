<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class PartnerStatistic
{
    public ?string $partnerId;
    public ?array $statistics = [];

    public function __construct(array $args = [])
    {
        if (array_key_exists('partnerId', $args)) {
            $this->partnerId = $args['partnerId'];
        }
        if (array_key_exists('statistics', $args)) {
            foreach ($args['statistics'] as $statistic) {
                $this->statistics[] = new Statistic($statistic);
            }
        }
    }
}