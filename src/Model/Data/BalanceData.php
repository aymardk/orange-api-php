<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class BalanceData
{
    private ?string $id;
    private ?string $type;
    private ?string $developerId;
    private ?string $applicationId;
    private ?string $country;
    private ?string $offerName;
    private ?int $availableUnits;
    private ?int $requestedUnits;
    private ?string $status;
    private ?string $expirationDate;
    private ?string $creationDate;
    private ?string $lastUpdateDate;

    public function __construct(array $args)
    {
        $this->id = $args['id'] ?? null;
        $this->type = $args['type'] ?? null;
        $this->developerId = $args['developerId'] ?? null;
        $this->applicationId = $args['applicationId'] ?? null;
        $this->country = $args['country'] ?? null;
        $this->offerName = $args['offerName'] ?? null;
        $this->availableUnits = $args['availableUnits'] ?? null;
        $this->requestedUnits = $args['requestedUnits'] ?? null;
        $this->status = $args['status'] ?? null;
        $this->expirationDate = $args['expirationDate'] ?? null;
        $this->creationDate = $args['creationDate'] ?? null;
        $this->lastUpdateDate = $args['lastUpdateDate'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getDeveloperId(): ?string
    {
        return $this->developerId;
    }

    /**
     * @return string|null
     */
    public function getApplicationId(): ?string
    {
        return $this->applicationId;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getOfferName(): ?string
    {
        return $this->offerName;
    }

    /**
     * @return int|null
     */
    public function getAvailableUnits(): ?int
    {
        return $this->availableUnits;
    }

    /**
     * @return int|null
     */
    public function getRequestedUnits(): ?int
    {
        return $this->requestedUnits;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getExpirationDate(): ?string
    {
        return $this->expirationDate;
    }

    /**
     * @return string|null
     */
    public function getCreationDate(): ?string
    {
        return $this->creationDate;
    }

    /**
     * @return string|null
     */
    public function getLastUpdateDate(): ?string
    {
        return $this->lastUpdateDate;
    }

}