<?php

namespace WATR\Models;

/**
 * Webhook Model
 */
class WebhookResponse
{
    /**
     * @var string identifiere of event
     */
    public $event_id;

    /**
     * @var string type of event
     */
    public $event_type;

    /**
     * @var FormResponse response
     */
    public $form_response;

    /**
     * constructor
     */
    public function __construct($json)
    {
        $this->event_id = $json->event_id;
        $this->event_type = $json->event_type;
        $this->form_response = new FormResponse($json->form_response);
    }
}
