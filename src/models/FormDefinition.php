<?php

namespace WATR\Models;

use WATR\Models\Answer;

/**
 * FormDefinition Model
 */
class FormDefinition
{
    /**
     * @var string Typeform unique identifier
     */
    public $id;

    /**
     * @var string title
     */
    public $title;

    /**
     * var Field[] settings
     */
    public $fields = [];

    /**
     * Form constructor
     */
    public function __construct($json)
    {
        $this->id = $json->id;
        $this->title = $json->title;

        foreach($json->fields as $field)
        {
            array_push($this->fields, new FieldDefinition($field));
        }
    }

    /**
     * Return field by identifier
     */
    public function getFieldByRef($identifier)
    {
        $result = -1;

        foreach($this->fields as $field)
        {
            if($field->ref == $identifier)
            {
                $result = $field;
                break;
            }
        }

        return $result;
    }
}
