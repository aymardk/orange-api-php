<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class OrderExecutionInformation
{
    public ?string $date;
    public ?int $amount;
    public ?string $currency;
    public ?string $service;
    public ?string $country;
    public ?string $contractId;

    public function __construct(array $args = [])
    {
        if (array_key_exists('date', $args)) {
            $this->date = $args['date'];
        }
        if (array_key_exists('amount', $args)) {
            $this->amount = $args['amount'];
        }
        if (array_key_exists('currency', $args)) {
            $this->currency = $args['currency'];
        }
        if (array_key_exists('service', $args)) {
            $this->service = $args['service'];
        }
        if (array_key_exists('country', $args)) {
            $this->country = $args['country'];
        }
        if (array_key_exists('contractId', $args)) {
            $this->contractId = $args['contractId'];
        }
    }
}