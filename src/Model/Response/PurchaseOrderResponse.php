<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardk\OrangeApiPhp\Model\Data\PurchaseOrderData;

class PurchaseOrderResponse
{
    public ?array $purchaseOrders;

    public function __construct(array $args = [])
    {
        foreach ($args as $arg) {
            $purchaseOrder = new PurchaseOrderData();

            if (array_key_exists('id', $arg)) {
                $purchaseOrder->id = $arg['id'];
            }
            if (array_key_exists('developerId', $arg)) {
                $purchaseOrder->developerId = $arg['developerId'];
            }
            if (array_key_exists('contractId', $arg)) {
                $purchaseOrder->contractId = $arg['contractId'];
            }
            if (array_key_exists('country', $arg)) {
                $purchaseOrder->country = $arg['country'];
            }
            if (array_key_exists('offerName', $arg)) {
                $purchaseOrder->offerName = $arg['offerName'];
            }
            if (array_key_exists('bundleId', $arg)) {
                $purchaseOrder->bundleId = $arg['bundleId'];
            }
            if (array_key_exists('bundleDescription', $arg)) {
                $purchaseOrder->bundleDescription = $arg['bundleDescription'];
            }
            if (array_key_exists('price', $arg)) {
                $purchaseOrder->price = $arg['price'];
            }
            if (array_key_exists('currency', $arg)) {
                $purchaseOrder->currency = $arg['currency'];
            }
            if (array_key_exists('purchaseDate', $arg)) {
                $purchaseOrder->purchaseDate = $arg['purchaseDate'];
            }
            if (array_key_exists('paymentMode', $arg)) {
                $purchaseOrder->paymentMode = $arg['paymentMode'];
            }
            if (array_key_exists('paymentProviderOrderId', $arg)) {
                $purchaseOrder->paymentProviderOrderId = $arg['paymentProviderOrderId'];
            }
            if (array_key_exists('payerId', $arg)) {
                $purchaseOrder->payerId = $arg['payerId'];
            }
            if (array_key_exists('type', $arg)) {
                $purchaseOrder->type = $arg['type'];
            }
            if (array_key_exists('oldAvailableUnits', $arg)) {
                $purchaseOrder->oldAvailableUnits = $arg['oldAvailableUnits'];
            }
            if (array_key_exists('newAvailableUnits', $arg)) {
                $purchaseOrder->newAvailableUnits = $arg['newAvailableUnits'];
            }
            if (array_key_exists('oldExpirationDate', $arg)) {
                $purchaseOrder->oldExpirationDate = $arg['oldExpirationDate'];
            }
            if (array_key_exists('newExpirationDate', $arg)) {
                $purchaseOrder->newExpirationDate = $arg['newExpirationDate'];
            }
            if (array_key_exists('externalId', $arg)) {
                $purchaseOrder->externalId = $arg['externalId'];
            }
            if (array_key_exists('comment', $arg)) {
                $purchaseOrder->comment = $arg['comment'];
            }

            $this->purchaseOrders[] = $purchaseOrder;
        }
    }
}