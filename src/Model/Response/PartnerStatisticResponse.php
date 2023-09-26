<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardk\OrangeApiPhp\Model\Data\PartnerStatisticData;
use Aymardk\OrangeApiPhp\Model\Data\Statistic;

class PartnerStatisticResponse
{
    public ?PartnerStatisticData $partnerStatistics;

    public function __construct(array $args = [])
    {
        if (array_key_exists('partnerStatistics', $args)) {
            $this->partnerStatistics = new PartnerStatisticData();

            if (array_key_exists('developerId', $args['partnerStatistics'])) {
                $this->partnerStatistics->developerId = $args['partnerStatistics']['developerId'];
            }
            if (array_key_exists('statistics', $args['partnerStatistics'])) {
                foreach ($args['partnerStatistics']['statistics'] as $statistic) {
                    $this->partnerStatistics->statistics[] = new Statistic($statistic);
                }
            }
        }
    }
}