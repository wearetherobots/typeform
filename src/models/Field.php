<?php

namespace WATR\Models;

use WATR\Models\FieldProperty;
use WATR\Models\Validation;
use WATR\Traits\jsonConverter;

/**
 * Field Model
 */
class Field
{
    use jsonConverter;
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
        $object = $this->toObject($object);

        $this->id = $object->id;
        $this->title = $object->title;
        $this->ref = $object->ref;
        $this->type = $object->type;

        if(isset($object->properties))
        {
            $this->properties = new FieldProperty($object->properties, $this->type == "group");
        }

        if(isset($object->validations))
        {
            $this->validations = new Validation($object->validations);
        }
    }
}
