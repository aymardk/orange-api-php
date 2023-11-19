<?php

namespace Aymardk\OrangeApiPhp\Feature;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Core\Endpoints;
use Aymardk\OrangeApiPhp\Core\Requests;
use Aymardk\OrangeApiPhp\Model\Response\BalanceResponse;
use Exception;

class Balance extends OrangeApi
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
                ),
            ],
            'get',
            Endpoints::getContracts(),
            $data
        );
    }

    /**
     * @param string|null $country_code
     * @return BalanceResponse
     * @throws Exception
     */
    public function check(string $country_code = null): BalanceResponse
    {
        $res = $this->attempt(['country_code' => $country_code], 200);
        return new BalanceResponse($res);
    }
}