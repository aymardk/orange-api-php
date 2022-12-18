<?php

namespace Aymardk\OrangeApiPhp\Feature;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Core\Endpoints;
use Aymardk\OrangeApiPhp\Core\Requests;
use Aymardk\OrangeApiPhp\Model\Response\BalanceResponse;

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
                $this->attempt(['country_code' => $country_code], 200)['response'][0]
            );
    }
}