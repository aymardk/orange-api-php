<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class PurchaseOrderData
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
    public ?string $externalId;
    public ?string $comment;
}