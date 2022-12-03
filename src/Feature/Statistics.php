<?php

namespace Aymardkouakou\OrangeApiPhp\Feature;

use Aymardkouakou\OrangeApiPhp\Core\Authorization;
use Aymardkouakou\OrangeApiPhp\Core\Endpoints;
use Aymardkouakou\OrangeApiPhp\Core\Requests;
use Aymardkouakou\OrangeApiPhp\Model\Response\PartnerStatisticResponse;

class Statistics extends OrangeApi
{
    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
    }

    /**
     * @param $args
     * @return array
     */
    protected function query(array $args): array
    {
        if (!is_array($args)) {
            if (array_key_exists('country_code', $args)) {
                $data['country'] = $args['country_code'];
            }
            if (array_key_exists('app_id', $args)) {
                $data['appid'] = $args['app_id'];
            }
        }

        return Requests::call(
            'GET',
            Endpoints::getStatistics(),
            $args,
            [
                'Content-Type: application/json',
                'Authorization: ' . $this->authorization->getTokenType() . ' ' . $this->authorization->getAccessToken()
            ],
            $this->authorization->getVerifyPeerSsl(),
            $this->logger
        );
    }

    /**
     * @param array $args ['country_code' => $country_code, 'app_id' => $app_id]
     * @return PartnerStatisticResponse
     * @throws \Exception
     */
    public function check(string $country_code, ?string $app_id = null): PartnerStatisticResponse
    {
        return
            new PartnerStatisticResponse($this->attempt(['country_code' => $country_code, 'app_id' => $app_id], 200)['response']);
    }
}