<?php

namespace WATR\Models;

/**
 * Link model
 */
class Link
{
    /**
     * @var string reference
     */
    public $display;

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->display = $object->display;
    }
}
