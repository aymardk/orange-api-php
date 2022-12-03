<?php

namespace Aymardkouakou\OrangeApiPhp\Feature;

use Aymardkouakou\OrangeApiPhp\Core\Authorization;
use Aymardkouakou\OrangeApiPhp\Core\Endpoints;
use Aymardkouakou\OrangeApiPhp\Core\Requests;
use Aymardkouakou\OrangeApiPhp\Model\Response\BalanceResponse;
use Aymardkouakou\OrangeApiPhp\Model\Response\PartnerContractResponse;

class Balance extends OrangeApi
{
    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
    }

    protected function query(array $args): array
    {
        $data = [];
        if ($args !== null) {
            if (array_key_exists('country_code', $args)) {
                $data['country'] = $args['country_code'];
            }
        }

        return Requests::call(
            'GET',
            Endpoints::getContracts(),
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
     * @return BalanceResponse
     * @throws \Exception
     */
    public function check(string $country_code = null): BalanceResponse
    {
        return
            new BalanceResponse(
                $this->attempt(['country_code' => $country_code], 200)['response']
            );
    }
}