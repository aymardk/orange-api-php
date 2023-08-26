<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class BalanceData
{
    public ?string $id;
    public ?string $type;
    public ?string $developerId;
    public ?string $applicationId;
    public ?string $country;
    public ?string $offerName;
    public ?int $availableUnits;
    public ?int $requestedUnits;
    public ?string $status;
    public ?string $expirationDate;
    public ?string $creationDate;
    public ?string $lastUpdateDate;

    public function __construct(array $args = [])
    {
        if (array_key_exists('id', $args)) {
            $this->id = $args['id'];
        }
        if (array_key_exists('type', $args)) {
            $this->type = $args['type'];
        }
        if (array_key_exists('developerId', $args)) {
            $this->developerId = $args['developerId'];
        }
        if (array_key_exists('applicationId', $args)) {
            $this->applicationId = $args['applicationId'];
        }
        if (array_key_exists('country', $args)) {
            $this->country = $args['country'];
        }
        if (array_key_exists('offerName', $args)) {
            $this->offerName = $args['offerName'];
        }
        if (array_key_exists('availableUnits', $args)) {
            $this->availableUnits = $args['availableUnits'];
        }
        if (array_key_exists('requestedUnits', $args)) {
            $this->requestedUnits = $args['requestedUnits'];
        }
        if (array_key_exists('status', $args)) {
            $this->status = $args['status'];
        }
        if (array_key_exists('', $args)) {
            $this->expirationDate = $args['expirationDate'];
        }
        if (array_key_exists('creationDate', $args)) {
            $this->creationDate = $args['creationDate'];
        }
        if (array_key_exists('lastUpdateDate', $args)) {
            $this->lastUpdateDate = $args['lastUpdateDate'];
        }
    }
}