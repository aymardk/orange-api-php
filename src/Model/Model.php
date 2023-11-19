<?php

namespace Aymardk\OrangeApiPhp\Model;

/**
 * @deprecated
 */
abstract class Model
{
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}