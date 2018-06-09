<?php
namespace WATR;

use GuzzleHttp\Client;
use WATR\Models\Form;

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

    public function getForm($formId)
    {
        $response = $this->http->get("/forms/" . $formId);
        $body = json_decode($response->getBody());
        return new Form($body);
    }

    public function getResponses($formId)
    {
        $response = $this->http->get("/forms/" . $formId . "/responses");
        $body = json_decode($response->getBody());
        return new Form($body);
    }

    public static function parseWebhook($json)
    {
    }
}
