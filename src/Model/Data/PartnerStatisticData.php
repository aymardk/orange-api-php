<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class PartnerStatisticData
{
    private ?string $partnerId;
    private ?string $developerId;
    private ?array $statistics;

    public function __construct(array $args)
    {
        $this->developerId = $args['developerId'] ?? null;
        $this->partnerId = $args['partnerId'] ?? null;
        $this->statistics = $args['statistics'] ?? [];
    }

    /**
     * @return string|null
     */
    public function getPartnerId(): ?string
    {
        return $this->partnerId;
    }

    /**
     * @return string|null
     */
    public function getDeveloperId(): ?string
    {
        return $this->developerId;
    }

    /**
     * @return array|null
     */
    public function getStatistics(): ?array
    {
        return $this->statistics;
    }

}