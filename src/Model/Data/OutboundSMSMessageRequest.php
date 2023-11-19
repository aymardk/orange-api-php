<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class OutboundSMSMessageRequest
{
    private ?OutboundSMSTextMessage $outboundSMSTextMessage;
    private ?string $senderAddress;
    private ?string $resourceURL;
    private ?string $senderName;
    private ?array $address;

    public function __construct(array $args)
    {
        $this->outboundSMSTextMessage = new OutboundSMSTextMessage(
            $args['outboundSMSTextMessage']
        ) ?? null;
        $this->senderAddress = $args['senderAddress'] ?? null;
        $this->resourceURL = $args['resourceURL'] ?? null;
        $this->senderName = $args['senderName'] ?? null;
        $this->address = $args['address'] ?? null;
    }

    /**
     * @return OutboundSMSTextMessage|null
     */
    public function getOutboundSMSTextMessage(): ?OutboundSMSTextMessage
    {
        return $this->outboundSMSTextMessage;
    }

    /**
     * @return string|null
     */
    public function getSenderAddress(): ?string
    {
        return $this->senderAddress;
    }

    /**
     * @return string|null
     */
    public function getResourceURL(): ?string
    {
        return $this->resourceURL;
    }

    /**
     * @return string|null
     */
    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    /**
     * @return array|null
     */
    public function getAddress(): ?array
    {
        return $this->address;
    }

}