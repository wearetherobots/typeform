<?php

namespace WATR\Models;
use WATR\Traits\jsonConverter;

/**
 * Screen Models
 */
class Screen
{
    use jsonConverter;
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
        $object = $this->toObject($object);

        $this->ref = $object->ref;
        $this->title = $object->title;
        $this->properties = new Property($object->properties);
        if(isset($object->attachment))
        {
            $this->attachment = new Attachment($object->attachment);
        }
    }
}
