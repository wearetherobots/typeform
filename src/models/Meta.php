<?php

namespace WATR\Models;

/**
 * Meta Model
 */
class Meta
{
    /**
     * @var boolean indexing
     */
    public $allow_indexing;

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->allow_indexing = $object->allow_indexing;
    }
}
