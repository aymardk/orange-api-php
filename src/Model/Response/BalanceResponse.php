<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardk\OrangeApiPhp\Model\Data\BalanceData;

class BalanceResponse
{
    private ?array $contracts;

    /**
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->contracts = [];

        foreach ($args as $arg) {
            $this->contracts[] = new BalanceData($arg);
        }
    }

    /**
     * @return array|null
     */
    public function getContracts(): ?array
    {
        return $this->contracts;
    }

}