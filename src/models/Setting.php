<?php

namespace WATR\Models;

/**
 * Setting Model
 */
class Setting
{
    /**
     * @var boolean public
     */
    public $is_public;

    /**
     * @var boolean trial
     */
    protected $is_trial;

    /**
     * @var string language
     */
    public $language;

    /**
     * @var string progress_bar
     */
    public $progress_bar;

    /**
     * @var boolean show progress bar
     */
    public $show_progress_bar;

    /**
     * @var boolean show branding
     */
    public $show_typeform_branding;

    /**
     * @var Meta
     */
    public $meta;

    /**
     * Constructor
     */
    public function __construct($object)
    {
        $this->is_public = $object->is_public;
        $this->is_trial = $object->is_trial;
        $this->language = $object->language;
        $this->progress_bar = $object->progress_bar;
        $this->show_progress_bar = $object->show_progress_bar;
        $this->show_typeform_branding = $object->show_typeform_branding;
        $this->meta = new Meta($object->meta);
    }
}
