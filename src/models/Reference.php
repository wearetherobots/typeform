<?php

namespace WATR\Models;

/**
 * Reference Model
 */
class Reference
{
    /**
     * @var string href reference
     */
    public $href;

    public function __construct($object)
    {
        $this->href = $object->href;
    }
}
