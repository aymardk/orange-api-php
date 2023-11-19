<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardk\OrangeApiPhp\Model\Data\PartnerStatisticData;

class PartnerStatisticResponse
{
    private PartnerStatisticData $partnerStatistics;

    /**
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->partnerStatistics = new PartnerStatisticData($args['partnerStatistics']) ?? null;
    }

    /**
     * @return PartnerStatisticData|null
     */
    public function getPartnerStatistics(): ?PartnerStatisticData
    {
        return $this->partnerStatistics;
    }

}