<?php

namespace Aymardk\OrangeApiPhp\Model\Data;

class OutboundSMSTextMessage
{
    private ?string $message;

    public function __construct(array $args)
    {
        $this->message = $args['message'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

}