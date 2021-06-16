<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Response;

use Aymardkouakou\OrangeApiPhp\Model\Data\PartnerContract;

class PartnerContractResponse
{
    public ?PartnerContract $partnerContracts;

    public function __construct(array $args = [])
    {
        if (array_key_exists('partnerContracts', $args)) {
            $this->partnerContracts = new PartnerContract($args['partnerContracts']);
        }
    }
}