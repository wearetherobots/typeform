<?php

namespace WATR\Models;

/**
 * Screen Models
 */
class Screen
{
    /**
     * @var string unique reference
     */
    public $ref;

    /**
     * @var string title
     */
    public $title;

    /**
     * @var Property properties
     */
    public $properties;

    /**
     * @var ref unique reference
     */
    public $attachment;

    /**
     * constructor
     */
    public function __construct($object)
    {
        $this->ref = $object->ref;
        $this->title = $object->title;
        $this->properties = new Property($object->properties);
        if(isset($object->attachment))
        {
            $this->attachment = new Attachment($object->attachment);
        }
    }
}
