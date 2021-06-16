<?php

namespace Aymardkouakou\OrangeApiPhp\Core;

class Endpoints
{
    private static string $scheme = 'https://';
    private static string $domain = 'api.orange.com';

    private static function getBase(): string
    {
        return self::$scheme . self::$domain;
    }

    public static function getAuthentication(): string
    {
        return self::getBase() . '/oauth/v3/token';
    }

    public static function getSmsMessaging(string $phoneNumber): string
    {
        return self::getBase()
            . sprintf(
                "%s/%s/%s",
                '/smsmessaging/v1/outbound', urlencode('tel:+' . $phoneNumber), 'requests'
            );
    }

    public static function getContracts(): string
    {
        return self::getBase() . '/sms/admin/v1/contracts';
    }

    public static function getStatistics(): string
    {
        return self::getBase() . '/sms/admin/v1/statistics';
    }

    public static function getPurchaseOrders(): string
    {
        return self::getBase() . '/sms/admin/v1/purchaseorders';
    }
}