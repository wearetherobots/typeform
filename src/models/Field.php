<?php

namespace WATR\Models;

use WATR\Models\FieldProperty;
use WATR\Models\Validation;

/**
 * Field Model
 */
class Field
{
    /**
     * @var string unique identifier
     */
    public $id;

    /**
     * @var string title
     */
    public $title;

    /**
     * @var string reference
     */
    public $ref;

    /**
     * @var Property string
     */
    public $properties;

    /**
     * @var Validation
     */
    public $validations;

    /**
     * @var string type of field
     */
    public $type;

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->id = $object->id;
        $this->title = $object->title;
        $this->ref = $object->ref;

        if(isset($object->properties))
        {
            $this->properties = new FieldProperty($object->properties);
        }

        $this->validations = new Validation($object->validations);
        $this->type = $object->type;
    }
}
