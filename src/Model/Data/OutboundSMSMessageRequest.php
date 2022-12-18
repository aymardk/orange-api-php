<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class OutboundSMSMessageRequest
{
    public ?array $address;
    public ?string $senderName;
    public ?string $senderAddress;
    public ?string $resourceURL;
    public ?OutboundSMSTextMessage $outboundSMSTextMessage;

    public function __construct(array $args = [])
    {
        if (array_key_exists('address', $args)) {
            $this->address = $args['address'];
        }
        if (array_key_exists('senderName', $args)) {
            $this->senderName = $args['senderName'];
        }
        if (array_key_exists('resourceURL', $args)) {
            $this->resourceURL = $args['resourceURL'];
        }

        // @deprecated
        if (array_key_exists('senderAddress', $args)) {
            $this->senderAddress = $args['senderAddress'];
        }
        if (array_key_exists('outboundSMSTextMessage', $args)) {
            $this->outboundSMSTextMessage = new OutboundSMSTextMessage($args['outboundSMSTextMessage']);
        }
    }
}