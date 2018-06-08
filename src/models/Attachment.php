<?php

namespace WATR\Models;

/**
 * Attachment Models
 */
class Attachment
{
    /**
     * @var string type
     */
    public $type;

    /**
     * @var string reference
     */
    public $href;

    /**
     * Constructor
     */
    public function __construct($object)
    {
        $this->type = $object->type;
        $this->href = $object->href;
    }
}
