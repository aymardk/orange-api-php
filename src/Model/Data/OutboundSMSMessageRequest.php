<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class OutboundSMSMessageRequest
{
    public ?array $address;
    public ?string $senderAddress;
    public ?OutboundSMSTextMessage $outboundSMSTextMessage;

    public function __construct(array $args = [])
    {
        if (array_key_exists('address', $args)) {
            $this->address = $args['address'];
        }
        if (array_key_exists('senderAddress', $args)) {
            $this->senderAddress = $args['senderAddress'];
        }
        if (array_key_exists('outboundSMSTextMessage', $args)) {
            $this->outboundSMSTextMessage = new OutboundSMSTextMessage($args['outboundSMSTextMessage']);
        }
    }
}