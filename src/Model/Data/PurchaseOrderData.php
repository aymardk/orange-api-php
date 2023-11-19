<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class PurchaseOrderData
{
    private ?string $id;
    private ?string $developerId;
    private ?string $contractId;
    private ?string $country;
    private ?string $offerName;
    private ?string $bundleId;
    private ?string $bundleDescription;
    private ?int $price;
    private ?string $currency;
    private ?string $purchaseDate;
    private ?string $paymentMode;
    private ?string $paymentProviderOrderId;
    private ?string $payerId;
    private ?string $type;
    private ?int $oldAvailableUnits;
    private ?int $newAvailableUnits;
    private ?string $oldExpirationDate;
    private ?string $newExpirationDate;
    private ?string $externalId;
    private ?string $comment;

    public function __construct(array $args)
    {
        $this->id = $args['id'] ?? null;
        $this->developerId = $args['developerId'] ?? null;
        $this->contractId = $args['contractId'] ?? null;
        $this->country = $args['country'] ?? null;
        $this->offerName = $args['offerName'] ?? null;
        $this->bundleId = $args['bundleId'] ?? null;
        $this->bundleDescription = $args['bundleDescription'] ?? null;
        $this->price = $args['price'] ?? null;
        $this->currency = $args['currency'] ?? null;
        $this->purchaseDate = $args['purchaseDate'] ?? null;
        $this->paymentMode = $args['paymentMode'] ?? null;
        $this->paymentProviderOrderId = $args['paymentProviderOrderId'] ?? null;
        $this->payerId = $args['payerId'] ?? null;
        $this->type = $args['type'] ?? null;
        $this->oldAvailableUnits = $args['oldAvailableUnits'] ?? null;
        $this->newAvailableUnits = $args['newAvailableUnits'] ?? null;
        $this->oldExpirationDate = $args['oldExpirationDate'] ?? null;
        $this->newExpirationDate = $args['newExpirationDate'] ?? null;
        $this->externalId = $args['externalId'] ?? null;
        $this->comment = $args['comment'] ?? null;
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
    public function getDeveloperId(): ?string
    {
        return $this->developerId;
    }

    /**
     * @return string|null
     */
    public function getContractId(): ?string
    {
        return $this->contractId;
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
     * @return string|null
     */
    public function getBundleId(): ?string
    {
        return $this->bundleId;
    }

    /**
     * @return string|null
     */
    public function getBundleDescription(): ?string
    {
        return $this->bundleDescription;
    }

    /**
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return string|null
     */
    public function getPurchaseDate(): ?string
    {
        return $this->purchaseDate;
    }

    /**
     * @return string|null
     */
    public function getPaymentMode(): ?string
    {
        return $this->paymentMode;
    }

    /**
     * @return string|null
     */
    public function getPaymentProviderOrderId(): ?string
    {
        return $this->paymentProviderOrderId;
    }

    /**
     * @return string|null
     */
    public function getPayerId(): ?string
    {
        return $this->payerId;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return int|null
     */
    public function getOldAvailableUnits(): ?int
    {
        return $this->oldAvailableUnits;
    }

    /**
     * @return int|null
     */
    public function getNewAvailableUnits(): ?int
    {
        return $this->newAvailableUnits;
    }

    /**
     * @return string|null
     */
    public function getOldExpirationDate(): ?string
    {
        return $this->oldExpirationDate;
    }

    /**
     * @return string|null
     */
    public function getNewExpirationDate(): ?string
    {
        return $this->newExpirationDate;
    }

    /**
     * @return string|null
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

}