<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class PurchaseOrder
{
    public ?string $id;
    public ?string $developerId;
    public ?string $contractId;
    public ?string $country;
    public ?string $offerName;
    public ?string $bundleId;
    public ?string $bundleDescription;
    public ?int $price;
    public ?string $currency;
    public ?string $purchaseDate;
    public ?string $paymentMode;
    public ?string $paymentProviderOrderId;
    public ?string $payerId;
    public ?string $type;
    public ?int $oldAvailableUnits;
    public ?int $newAvailableUnits;
    public ?string $oldExpirationDate;
    public ?string $newExpirationDate;

    public function __construct(array $args = [])
    {
        if (array_key_exists('id', $args)) {
            $this->id = $args['id'];
        }
        if (array_key_exists('developerId', $args)) {
            $this->developerId = $args['developerId'];
        }
        if (array_key_exists('contractId', $args)) {
            $this->contractId = $args['contractId'];
        }
        if (array_key_exists('country', $args)) {
            $this->country = $args['country'];
        }
        if (array_key_exists('offerName', $args)) {
            $this->offerName = $args['offerName'];
        }
        if (array_key_exists('bundleId', $args)) {
            $this->bundleId = $args['bundleId'];
        }
        if (array_key_exists('bundleDescription', $args)) {
            $this->bundleDescription = $args['bundleDescription'];
        }
        if (array_key_exists('price', $args)) {
            $this->price = $args['price'];
        }
        if (array_key_exists('currency', $args)) {
            $this->currency = $args['currency'];
        }
        if (array_key_exists('purchaseDate', $args)) {
            $this->purchaseDate = $args['purchaseDate'];
        }
        if (array_key_exists('paymentMode', $args)) {
            $this->paymentMode = $args['paymentMode'];
        }
        if (array_key_exists('paymentProviderOrderId', $args)) {
            $this->paymentProviderOrderId = $args['paymentProviderOrderId'];
        }
        if (array_key_exists('payerId', $args)) {
            $this->payerId = $args['payerId'];
        }
        if (array_key_exists('type', $args)) {
            $this->type = $args['type'];
        }
        if (array_key_exists('oldAvailableUnits', $args)) {
            $this->oldAvailableUnits = $args['oldAvailableUnits'];
        }
        if (array_key_exists('newAvailableUnits', $args)) {
            $this->newAvailableUnits = $args['newAvailableUnits'];
        }
        if (array_key_exists('oldExpirationDate', $args)) {
            $this->oldExpirationDate = $args['oldExpirationDate'];
        }
        if (array_key_exists('newExpirationDate', $args)) {
            $this->newExpirationDate = $args['newExpirationDate'];
        }
    }
}