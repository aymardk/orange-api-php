<?php

namespace Aymardk\OrangeApiPhp\Feature;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Core\Endpoints;
use Aymardk\OrangeApiPhp\Core\Requests;
use Aymardk\OrangeApiPhp\Model\Response\SMSMessageResponse;
use Exception;

class SMSMessage extends OrangeApi
{
    private ?string $address;
    private ?string $senderName;
    private ?string $senderAddress;
    private array $request = [];

    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
        $this->useDefaultSenderName();
    }

    /**
     * @param array $args
     * @return array
     */
    protected function query(array $args): array
    {
        $this->request += [
            'outboundSMSTextMessage' => $args,
            'senderAddress' => "tel:+$this->senderAddress",
            'address' => "tel:+$this->address",
        ];

        if ($this->senderName !== null) {
            $this->request += ['senderName' => $this->senderName];
        }

        $data = ['outboundSMSMessageRequest' => $this->request];

        $request = new Requests($this->logger);
        return $request->call(
            [
                'Authorization' => sprintf(
                    "%s %s",
                    $this->authorization->getTokenType(),
                    $this->authorization->getAccessToken()
                )
            ],
            'post',
            Endpoints::getSmsMessaging($this->senderAddress),
            $data,
        );
    }

    /**
     * @param string $format
     * @param mixed ...$values
     * @return SMSMessageResponse
     * @throws Exception
     */
    public function send(string $format, ...$values): SMSMessageResponse
    {
        $res = $this->attempt(['message' => sprintf($format, $values)], 201);
        return new SMSMessageResponse($res);
    }

    /**
     * @param string|null $address
     * @return SMSMessage
     */
    public function withAddress(?string $address): SMSMessage
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string|null $senderName
     * @return SMSMessage
     */
    public function withSenderName(?string $senderName): SMSMessage
    {
        $this->senderName = $senderName;
        return $this;
    }

    public function useDefaultSenderName(): SMSMessage
    {
        $this->senderName = null;
        return $this;
    }

    /**
     * @param string|null $senderAddress
     * @return SMSMessage
     */
    public function withSenderAddress(?string $senderAddress): SMSMessage
    {
        $this->senderAddress = $senderAddress;
        return $this;
    }

}