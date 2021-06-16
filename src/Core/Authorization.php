<?php

namespace Aymardkouakou\OrangeApiPhp\Core;

use Symfony\Component\Filesystem\Filesystem;

class Authorization
{
    protected bool $verifyPeerSsl = true;
    protected ?string $clientSecret = null;
    protected ?string $accessToken = null;
    protected ?string $tokenType = null;
    protected ?string $clientId = null;
    protected ?string $logPathName = 'authorize';
    protected ?string $logPath;

    /**
     * Authorization constructor.
     * @param string $clientId
     * @param string $clientSecret
     * @param bool $verifyPeerSsl
     * @param string $logPath
     */
    public function __construct(string $clientId, string $clientSecret, bool $verifyPeerSsl = true, string $logPath = './tmp')
    {
        $this->logPath = sprintf("%s/%s/%s", $logPath, $clientId, $this->logPathName);

        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->verifyPeerSsl = $verifyPeerSsl;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getLogPath(): string
    {
        return $this->logPath;
    }

    public function getVerifyPeerSsl(): bool
    {
        return $this->verifyPeerSsl;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
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
            $callResponse = Requests::call(
                'POST',
                Endpoints::getAuthentication(),
                ['grant_type' => 'client_credentials'],
                [
                    'Accept: application/json',
                    'Content-Type: application/x-www-form-urlencoded',
                    "Authorization: Basic " . base64_encode("$this->clientId:$this->clientSecret"),
                ],
                $this->verifyPeerSsl
            );

            if ($callResponse['code'] !== 200) {
                throw new \RuntimeException('There is an error!');
            }

            if (array_key_exists('access_token', $callResponse['response'])) {
                $this->accessToken = $callResponse['response']['access_token'];
            }

            if (array_key_exists('token_type', $callResponse['response'])) {
                $this->tokenType = $callResponse['response']['token_type'];
            }

            $fs->dumpFile($this->logPath, json_encode($callResponse['response']));
        }

        return true;
    }

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
                        throw new \RuntimeException("access_token or token_type not present in json authorize file.");
                    }
                    $this->accessToken = $json['access_token'];
                    $this->tokenType = $json['token_type'];
                    return true;
                }
            }
        }

        return false;
    }
}