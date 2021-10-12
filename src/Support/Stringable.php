<?php

namespace Hahadu\ThinkAdmin\Support;
use Hahadu\ThinkAdmin\Traits\Conditionable;
use Illuminate\Support\Traits\Macroable;
use Hahadu\ThinkAdmin\Traits\Tappable;
use JsonSerializable;
class Stringable implements JsonSerializable
{
    use Conditionable,Tappable,Macroable;


    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}