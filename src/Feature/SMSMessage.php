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

    private array $request;

    public function __construct(Authorization $authorization, string $logPath = null)
    {
        parent::__construct($authorization, $logPath);
    }

    protected function query(array $args): array
    {
        $this->request = [
            'senderAddress' => "tel:+$this->senderAddress",
            'address' => "tel:+$this->address",
            'outboundSMSTextMessage' => [
                'message' => $args['message']
            ]
        ];

        if ($this->senderName !== null) {
            $this->request['senderName'] = $this->senderName;
        }

        $data = json_encode([
            'outboundSMSMessageRequest' => $this->request
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