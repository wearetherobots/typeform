<?php

namespace WATR\Models;
use WATR\Traits\jsonConverter;

/**
 * Field Model
 */
class Answer
{
    use jsonConverter;
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

    public $ref;

    /**
     * constructor
     */
    public function __construct($object)
    {
        $object = $this->toObject($object);

        $this->type = $object->type;
        $this->field_identifier = $object->field->id;
        $this->ref = $object->field->ref;
        $this->answer = $object->{$this->type};
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function getType()
    {
        return $this->type;
    }
}
