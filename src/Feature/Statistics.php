<?php

namespace Aymardk\OrangeApiPhp\Feature;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Core\Endpoints;
use Aymardk\OrangeApiPhp\Core\Requests;
use Aymardk\OrangeApiPhp\Model\Response\PartnerStatisticResponse;
use Exception;

class Statistics extends OrangeApi
{
    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
    }

    /**
     * @param array $args
     * @return array
     */
    protected function query(array $args): array
    {
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
            Endpoints::getStatistics(),
            $args
        );
    }

    /**
     * @param string|null $country_code
     * @param string|null $app_id
     * @return PartnerStatisticResponse
     * @throws Exception
     */
    public function check(?string $country_code = null, ?string $app_id = null): PartnerStatisticResponse
    {
        $data = [];
        if ($country_code !== null) {
            $data['country'] = $country_code;
        }
        if ($country_code !== null) {
            $data['appid'] = $app_id;
        }

        return new PartnerStatisticResponse(
            $this->attempt($data, 200)
        );
    }
}