<?php

namespace Aymardkouakou\OrangeApiPhp\Feature;

use Aymardkouakou\OrangeApiPhp\Core\Authorization;
use Aymardkouakou\OrangeApiPhp\Core\Endpoints;
use Aymardkouakou\OrangeApiPhp\Core\Requests;
use Aymardkouakou\OrangeApiPhp\Model\Response\PurchaseOrderResponse;

class PurchaseHistory extends OrangeApi
{
    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
    }

    protected function query($args): array
    {
        $data = [];

        if ($args !== null) {
            $data['country_code'] = $args;
        }

        return Requests::call(
            'GET',
            Endpoints::getPurchaseOrders(),
            $data,
            [
                'Content-Type: application/json',
                'Authorization: ' . $this->authorization->getTokenType() . ' ' . $this->authorization->getAccessToken()
            ],
            $this->authorization->getVerifyPeerSsl(),
            $this->logger
        );
    }

    /**
     * @param string|null $country_code
     * @return PurchaseOrderResponse
     * @throws \Exception
     */
    public function check(string $country_code = null): PurchaseOrderResponse
    {
        return
            new PurchaseOrderResponse(
                $this->attempt($country_code, 200)['response']
            );
    }
}