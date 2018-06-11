<?php

namespace WATR\Models;

/**
 * Field Model
 */
class Answer
{
    /**
     * @var Validation
     */
    public $answer;

    /**
     * @var string type of field
     */
    public $type;

    /**
     * @var string type of field
     */
    public $field_identifier;

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->type = $object->type;
        $this->field_identifier = $object->field->id;
        $this->answer = $object->{$this->type};
    }
}
