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
     * @var Field[] fields
     */
    public $fields = [];

    /**
     * @var Choice[] choices
     */
    public $choices = [];

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->id = $object->id;
        $this->title = $object->title;
        if(isset($object->ref))
        {
            $this->ref = $object->ref;
        }
        $this->type = $object->type;
        if(isset($object->randomize))
        {
            $this->randomize = $object->randomize;
        }
        if(isset($object->allow_multiple_selection))
        {
            $this->allow_multiple_selection = $object->allow_multiple_selection;
        }
        if(isset($object->allow_other_choice))
        {
            $this->allow_other_choice = $object->allow_other_choice;
        }
        if(isset($object->vertical_alignment))
        {
            $this->vertical_alignment = $object->vertical_alignment;
        }
        if(isset($object->steps))
        {
            $this->steps = $object->steps;
        }
        if(isset($object->start_at_one))
        {
            $this->start_at_one = $object->start_at_one;
        }

        if(isset($object->choices))
        {
            foreach($object->choices as $choice)
            {
                array_push($this->choices, new Choice($choice));
            }
        }

        if(isset($object->fields) && $this->type == "group")
        {
            foreach($object->fields as $field)
            {
                array_push($this->fields, new Field($field));
            }
        }
    }
}
