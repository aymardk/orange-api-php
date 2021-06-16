<?php

namespace Aymardkouakou\OrangeApiPhp\Model\Data;

class OrderInput
{
    public ?string $type;
    public ?string $value;

    public function __construct(array $args = [])
    {
        if (array_key_exists('type', $args)) {
            $this->type = $args['type'];
        }
        if (array_key_exists('value', $args)) {
            $this->value = $args['value'];
        }
    }
}