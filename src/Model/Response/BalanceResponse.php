<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardk\OrangeApiPhp\Model\Data\BalanceData;

class BalanceResponse
{
    public ?BalanceData $balance = null;

    public function __construct(array $args = [])
    {
        $this->balance = new BalanceData();

        if (array_key_exists('id', $args)) {
            $this->balance->id = $args['id'];
        }
        if (array_key_exists('type', $args)) {
            $this->balance->type = $args['type'];
        }
        if (array_key_exists('developerId', $args)) {
            $this->balance->developerId = $args['developerId'];
        }
        if (array_key_exists('applicationId', $args)) {
            $this->balance->applicationId = $args['applicationId'];
        }
        if (array_key_exists('country', $args)) {
            $this->balance->country = $args['country'];
        }
        if (array_key_exists('offerName', $args)) {
            $this->balance->offerName = $args['offerName'];
        }
        if (array_key_exists('availableUnits', $args)) {
            $this->balance->availableUnits = $args['availableUnits'];
        }
        if (array_key_exists('requestedUnits', $args)) {
            $this->balance->requestedUnits = $args['requestedUnits'];
        }
        if (array_key_exists('status', $args)) {
            $this->balance->status = $args['status'];
        }
        if (array_key_exists('', $args)) {
            $this->balance->expirationDate = $args['expirationDate'];
        }
        if (array_key_exists('creationDate', $args)) {
            $this->balance->creationDate = $args['creationDate'];
        }
        if (array_key_exists('lastUpdateDate', $args)) {
            $this->balance->lastUpdateDate = $args['lastUpdateDate'];
        }
    }
}