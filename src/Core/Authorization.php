<?php

namespace Aymardk\OrangeApiPhp\Core;

use Cake\Http\Client;
use Symfony\Component\Filesystem\Filesystem;

class Authorization
{
    private ?string $clientSecret;
    private ?string $accessToken;
    private ?string $tokenType;
    private ?string $clientId;
    private ?string $logPath;

    /**
     * @param Filesystem $fs
     * @return bool
     */
    private function hasToken(Filesystem $fs): bool
    {
        if ($fs->exists($this->logPath)) {
            $file = new File($this->logPath);

            $iterator = $file->iterate();
            foreach ($iterator as $line) {
                if (!empty($line)) {
                    $json = json_decode(trim($line), true);
                    if (!array_key_exists('access_token', $json) || !array_key_exists('token_type', $json)) {
                        throw new \RuntimeException("access_token/token_type not present.");
                    }

                    $this->accessToken = $json['access_token'];
                    $this->tokenType = $json['token_type'];

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Authorization constructor.
     * @param string $clientId
     * @param string $clientSecret
     * @param string $logPath
     */
    public function __construct(string $clientId, string $clientSecret, string $logPath = 'tmp')
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->logPath = sprintf(
            "%s/%s/%s",
            $logPath,
            $this->clientId,
            'authorize'
        );
    }

    /**
     * @throws \Exception
     */
    public function init(): bool
    {
        if ($this->clientId === null || $this->clientSecret === null) {
            return false;
        }

        $fs = new Filesystem();

        if ($this->hasToken($fs) === false) {
            $client = new Client();
            $result = $client->post(
                Endpoints::getAuthentication(),
                ['grant_type' => 'client_credentials'],
                [
                    'auth' => [
                        'type' => 'basic',
                        'username' => $this->clientId,
                        'password' => $this->clientSecret,
                    ]
                ]);

            if (!$result->isSuccess()) {
                throw new \RuntimeException($result->getJson()['message']);
            }

            if (!in_array($result->getStatusCode(), [200, 201])) {
                throw new \RuntimeException($result->getJson()['message']);
            }

            if (array_key_exists('access_token', $result->getJson())) {
                $this->accessToken = $result->getJson()['access_token'];
            }

            if (array_key_exists('token_type', $result->getJson())) {
                $this->tokenType = $result->getJson()['token_type'];
            }

            $fs->dumpFile($this->logPath, json_encode($result->getJson()));
        }

        return true;
    }

    /**
     * @return string|null
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @return string|null
     */
    public function getTokenType(): ?string
    {
        return $this->tokenType;
    }

    /**
     * @return string|null
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @return string|null
     */
    public function getLogPath(): ?string
    {
        return $this->logPath;
    }

}