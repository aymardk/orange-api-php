<?php

namespace Aymardk\OrangeApiPhp\Model\Response;

use Aymardk\OrangeApiPhp\Model\Data\OutboundSMSMessageRequest;

class SMSMessageResponse
{
    private ?OutboundSMSMessageRequest $outboundSMSMessageRequest;

    /**
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        $this->outboundSMSMessageRequest = new OutboundSMSMessageRequest(
            $args['outboundSMSMessageRequest']
        ) ?? null;
    }

    public function getOutboundSMSMessageRequest(): ?OutboundSMSMessageRequest
    {
        return $this->outboundSMSMessageRequest;
    }
}