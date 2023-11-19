<?php

namespace Aymardk\OrangeApiPhp\Feature;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Core\Endpoints;
use Aymardk\OrangeApiPhp\Core\Requests;
use Aymardk\OrangeApiPhp\Model\Response\PurchaseOrderResponse;
use Exception;

class PurchaseHistory extends OrangeApi
{
    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
    }

    /**
     * @throws Exception
     */
    protected function query(array $args): array
    {
        $data = [];
        if (array_key_exists('country_code', $args)) {
            $data += ['country' => $args['country_code']];
        }

        $request = new Requests($this->logger);
        return $request->call(
            [
                'Authorization' => sprintf(
                    "%s %s",
                    $this->authorization->getTokenType(),
                    $this->authorization->getAccessToken()
                )
            ],
            'get',
            Endpoints::getPurchaseOrders(),
            $data,
        );
    }

    /**
     * @param string|null $country_code
     * @return PurchaseOrderResponse
     * @throws Exception
     */
    public function check(string $country_code = null): PurchaseOrderResponse
    {
        return
            new PurchaseOrderResponse(
                $this->attempt(['country_code' => $country_code], 200)
            );
    }
}