<?php

namespace WATR\Models;

use WATR\Models\Choice;

/**
 * FieldProperty Model
 */
class FieldProperty
{
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
     * @var Choice[]
     */
    public $choices = [];

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->randomize = $object->allow_multiple_selection;
        $this->allow_multiple_selection = $object->allow_multiple_selection;
        $this->allow_other_choice = $object->allow_other_choice;
        $this->vertical_alignment = $object->vertical_alignment;

        foreach($object->choices as $choice)
        {
            array_push($this->choices, new Choice($choice));
        }
    }
}
