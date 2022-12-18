<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardkouakou\OrangeApiPhp\Model\Data\BalanceData;

class BalanceResponse
{
    public ?BalanceData $balance;

    public function __construct(array $args = [])
    {
        $this->balance = new BalanceData($args);
    }
}