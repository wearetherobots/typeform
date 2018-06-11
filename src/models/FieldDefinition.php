<?php

namespace WATR\Models;

/**
 * Field Model
 */
class FieldDefinition
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
     * @var string type of field
     */
    public $type;

    /**
     * @var boolean multiple selection
     */
    public $allow_multiple_selections;

    /**
     * @var boolean other choice
     */
    public $allow_other_choice;

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->id = $object->id;
        $this->title = $object->title;
        $this->ref = $object->ref;
        $this->type = $object->type;
        $this->allow_multiple_selections = $object->allow_multiple_selections;
        $this->allow_other_choice = $object->allow_other_choice;
    }
}
