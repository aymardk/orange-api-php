<?php

namespace Aymardk\OrangeApiPhp\Feature;

use Aymardk\OrangeApiPhp\Core\Authorization;
use Aymardk\OrangeApiPhp\Core\Endpoints;
use Aymardk\OrangeApiPhp\Core\Requests;
use Aymardk\OrangeApiPhp\Model\Response\SMSMessageResponse;

class SMSMessage extends OrangeApi
{
    protected ?string $address = null;
    protected ?string $senderName = null;
    protected ?string $senderAddress = null;

    private array $request = [];

    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
    }

    /**
     * @throws \Exception
     */
    protected function query(array $args): array
    {
        $this->request += [
            'senderAddress' => "tel:+$this->senderAddress",
            'address' => "tel:+$this->address",
            'outboundSMSTextMessage' => [
                'message' => $args['message']
            ]
        ];

        if ($this->senderName !== null) {
            $this->request += ['senderName' => $this->senderName];
        }

        $data = [
            'outboundSMSMessageRequest' => $this->request
        ];

        return Requests::call(
            [
                'Authorization' => $this->authorization->getTokenType() . ' ' . $this->authorization->getAccessToken(),
            ],
            'post',
            Endpoints::getSmsMessaging($this->senderAddress),
            $data,
            $this->logger
        );
    }

    public function withAddress(string $address): SMSMessage
    {
        $this->address = $address;
        return $this;
    }

    public function withSenderAddress(string $senderAddress): SMSMessage
    {
        $this->senderAddress = $senderAddress;
        return $this;
    }

    public function withSenderName(string $senderName): SMSMessage
    {
        $this->senderName = $senderName;
        return $this;
    }

    /**
     * @param string $message
     * @return SMSMessageResponse
     * @throws \Exception
     */
    public function send(string $message): SMSMessageResponse
    {
        if ($this->address === null || $this->senderAddress === null) {
            throw new \RuntimeException('address and senderAddress must be provided.');
        }

        return
            new SMSMessageResponse(
                $this->attempt(['message' => $message], 201)['response']
            );
    }
}