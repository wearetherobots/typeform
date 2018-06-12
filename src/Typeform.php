<?php
namespace WATR;

use GuzzleHttp\Client;
use WATR\Models\Form;
use WATR\Models\WebhookResponse;

/**
 * Base Package wrapper for Typeform API
 */
class Typeform
{
    /**
     * @var  GuzzleHttp\Client
     */
    protected $http;

    /**
     * @var  string Typeform API key
     */
    protected $apiKey;

    /**
     * @var string Typeform base URI
     */
    protected $baseUri = 'https://api.typeform.com/';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->http = new Client([
            'base_uri' => $this->baseUri,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ]
        ]);
    }

    /**
     * Get form information
     */
    public function getForm($formId)
    {
        $response = $this->http->get("/forms/" . $formId);
        $body = json_decode($response->getBody());
        return new Form($body);
    }

    /**
     * Get form responses
     */
    public function getResponses($formId)
    {
        $response = $this->http->get("/forms/" . $formId . "/responses");
        $body = json_decode($response->getBody());
        return new Form($body);
    }

    /**
     * Register webhook for form
     */
    public function registerWebhook(Form $form, string $url)
    {
        $response = $this->http->put(
            "/forms/" . $form->id . "/webhooks/response",
            [
                'json' => [
                    'url' => $url,
                    'enabled' => true,
                ]
            ]
        );
        return json_decode($response->getBody());
    }

    /**
     * Parse incoming webhook
     */
    public static function parseWebhook($json)
    {
        return new WebhookResponse($json);
    }
}
