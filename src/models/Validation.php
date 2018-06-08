<?php

namespace WATR\Models;

/**
 * Validation Model
 */
class Validation
{
    /**
     * @var boolean required
     */
    public $required;

    /**
     * Constructor
     */
    public function __construct($object)
    {
        $this->required = $object->required;
    }
}
