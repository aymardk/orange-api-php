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
    protected function query($args): array
    {
        if (!is_array($args)) {
            throw new \RuntimeException('args must be an array.');
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
    public function check(array $args = []): PartnerStatisticResponse
    {
        return
            new PartnerStatisticResponse($this->attempt($args, 200)['response']);
    }
}