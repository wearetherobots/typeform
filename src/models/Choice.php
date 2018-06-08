<?php

namespace WATR\Models;

/**
 * Choice Model
 */
class Choice
{
    /**
     * @var string unique identifier
     */
    public $id;

    /**
     * @var string reference
     */
    public $ref;

    /**
     * @var string label
     */
    public $label;

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->id = $object->id;
        $this->ref = $object->ref;
        $this->label = $object->label;
    }
}
