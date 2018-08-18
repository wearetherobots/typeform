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
        if(isset($object->id))
        {
            $this->id = $object->id;
        }
        if(isset($object->ref))
        {
            $this->ref = $object->ref;
        }
        $this->label = $object->label;
    }
}
