<?php

namespace Aymardkouakou\OrangeApiPhp\Core;

use Monolog\Logger;

class Requests
{
    protected static ?Logger $logger = null;

    /**
     * @param string $method Method POST|GET
     * @param string $url
     * @param $data
     * @param array $headers
     * @param bool $verifyPeerSsl
     * @param Logger|null $logger
     * @return array
     */
    public static function call(
        string $method,
        string $url,
        $data,
        array $headers = [],
        bool $verifyPeerSsl = true,
        Logger $logger = null
    ): array
    {
        if (!in_array($method, ['POST', 'GET'])) {
            throw new \RuntimeException('Method not acceptable');
        }

        $ch = curl_init();

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt(
                $ch,
                CURLOPT_POSTFIELDS,
                is_array($data) ? http_build_query($data) : $data
            );
        } else { // GET method
            curl_setopt($ch, CURLOPT_URL, $url . ((!empty($data)) ? '?' . http_build_query($data) : ''));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifyPeerSsl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (!$result = curl_exec($ch)) {
            if ($logger !== null) {
                $logger->error(curl_error($ch));
            }
            trigger_error(curl_error($ch));
        }

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response = json_decode($result, true);

        curl_close($ch);

        $return = $response4log = [
            'code' => $httpCode,
            'response' => $response
        ];

        foreach (['outboundSMSTextMessage', 'senderAddress'] as $unwanted) {
            self::recursiveUnset($response4log, $unwanted);
        }

        if ($logger !== null) {
            $logger->log(in_array($httpCode, [200, 201]) ? Logger::DEBUG : Logger::ERROR, json_encode($response4log));
        }

        return $return;
    }

    private static function recursiveUnset(&$array, string $unwanted_key)
    {
        unset($array[$unwanted_key]);
        foreach ($array as &$value) {
            if (is_array($value)) {
                self::recursiveUnset($value, $unwanted_key);
            }
        }
    }
}