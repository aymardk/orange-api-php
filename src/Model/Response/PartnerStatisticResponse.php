<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Response;

use Aymardkouakou\OrangeApiPhp\Model\Data\PartnerStatistic;

class PartnerStatisticResponse
{
    public ?PartnerStatistic $partnerStatistics;

    public function __construct(array $args = [])
    {
        if (array_key_exists('partnerStatistics', $args)) {
            $this->partnerStatistics = new PartnerStatistic($args['partnerStatistics']);
        }
    }
}