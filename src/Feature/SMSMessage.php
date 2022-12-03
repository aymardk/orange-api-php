<?php

namespace Aymardkouakou\OrangeApiPhp\Feature;

use Aymardkouakou\OrangeApiPhp\Core\Authorization;
use Aymardkouakou\OrangeApiPhp\Core\Endpoints;
use Aymardkouakou\OrangeApiPhp\Core\Requests;
use Aymardkouakou\OrangeApiPhp\Model\Response\SMSMessageResponse;

class SMSMessage extends OrangeApi
{
    protected ?string $address = null;
    protected ?string $senderName = null;
    protected ?string $senderAddress = null;

    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
    }

    protected function query(array $args): array
    {
        $data = json_encode([
            'outboundSMSMessageRequest' => [
                'address' => "tel:+$this->address",
                'senderName' => $this->senderName,
                'senderAddress' => "tel:+$this->senderAddress",
                'outboundSMSTextMessage' => [
                    'message' => $args['message']
                ]
            ]
        ], JSON_FORCE_OBJECT);

        return Requests::call(
            'POST',
            Endpoints::getSmsMessaging($this->senderAddress),
            $data,
            [
                "Content-Type: application/json",
                sprintf("Content-Length: %s", strlen($data)),
                sprintf("Authorization: %s %s", $this->authorization->getTokenType(), $this->authorization->getAccessToken()),
            ],
            $this->authorization->getVerifyPeerSsl(),
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