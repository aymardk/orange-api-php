<?php

namespace Aymardk\OrangeApiPhp\Feature;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Exception;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

abstract class OrangeApi
{
    protected ?Logger $logger;
    protected ?Authorization $authorization;

    protected abstract function query(array $args): array;

    /**
     * @throws Exception
     */
    protected function attempt(array $args, int $response_code): array
    {
        if ($this->isAuthorized()) {
            $res = $this->query($args);
            if (array_key_exists('code', $res) && $res['code'] !== $response_code) {
                if ((int)$res['code'] === 42) {
                    if ($this->authorization->getLogPath() !== null) {
                        unlink($this->authorization->getLogPath());
                    }
                    if ($this->isAuthorized()) {
                        $res = $this->attempt($args, $response_code);
                    }
                }
            }
            return $res;
        } else {
            return $this->attempt($args, $response_code);
        }
    }

    /**
     * @param Authorization $authorization
     * @param string|null $logPath
     * @param string $logExt
     */
    public function __construct(Authorization $authorization, string $logPath = null, string $logExt = '.log')
    {
        $this->authorization = $authorization;

        if ($logPath !== null) {
            $stream = new StreamHandler(
                $logPath . '/sms_reporting_' . gmdate('Ymd') . $logExt,
                Logger::DEBUG
            );

            $this->logger = new Logger($this->authorization->getClientId());
            $this->logger->pushHandler($stream);
            $this->logger->pushHandler(new BrowserConsoleHandler());
        }
    }

    /**
     * @throws Exception
     */
    private function isAuthorized(): bool
    {
        return $this->authorization->init();
    }
}