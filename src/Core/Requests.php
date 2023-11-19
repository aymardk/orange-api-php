<?php

namespace Aymardk\OrangeApiPhp\Core;

use Cake\Http\Client;
use Monolog\Logger;

class Requests
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param array $headers
     * @param string $method Method post|get
     * @param string $url
     * @param array $data
     * @return array
     */
    public function call(array $headers, string $method, string $url, array $data = []): array
    {
        $client = new Client();
        $result = $client
            ->$method($url, json_encode($data), ['headers' => $headers, 'type' => 'json']);

        $json = $result->getJson();

        $this->logger->log(
            (in_array($result->getStatusCode(), [200, 201]) ? Logger::DEBUG : Logger::ERROR),
            json_encode($json)
        );

        return $json;
    }
}