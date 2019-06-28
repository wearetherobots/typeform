<?php

namespace WATR\Models;

use WATR\Models\Choice;
use WATR\Models\Field;
use WATR\Traits\jsonConverter;

/**
 * FieldProperty Model
 */
class FieldProperty
{
    use jsonConverter;
    /**
     * @var boolean randomize
     */
    public $randomize;

    /**
     * @var boolean multiple selection
     */
    public $allow_multiple_selection;

    /**
     * @var boolean other choice
     */
    public $allow_other_choice;

    /**
     * @var boolean vertical alignment
     */
    public $vertical_alignment;

    /**
     * @var int steps
     */
    public $steps;

    /**
     * @var boolean start interval
     */
    public $start_at_one;

    /**
     * @var Choice[]
     */
    public $choices = [];

    /**
     * @var Field[]
     */
    public $fields = [];

    /**
     * constructor
     */
    public function __construct($object, bool $group)
    {
        $object = $this->toObject($object);

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

        if(isset($object->fields) && $group)
        {
            foreach($object->fields as $field)
            {
                array_push($this->fields, new Field($field));
            }
        }
    }
}
