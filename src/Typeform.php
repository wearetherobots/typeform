<?php
namespace WATR;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use WATR\Iterators\AfterIterator;
use WATR\Iterators\FormIterator;
use WATR\Iterators\PageIterator;
use WATR\Iterators\ResoinseIterator;
use WATR\Models\Form;
use WATR\Models\FormResponse;
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
     * @param array $params
     * @return FormIterator
     */
    public function getForms(array $params = [])
    {
        return new FormIterator($this->http, '/forms', $params);
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
    public function getResponses($formId, array $params = [])
    {
        return new ResoinseIterator($this->http, "/forms/" . $formId . "/responses", $params);
//        $response = $this->http->get("/forms/" . $formId . "/responses");
//        $body = json_decode($response->getBody());
//        $responses = [];
//        if (isset($body->items)) {
//            foreach ($body->items as $item) {
//                $responses[] = new FormResponse($item);
//            }
//        }
//        return $responses;
    }

    /**
     * Register webhook for form responses
     */
    public function registerWebhook($form, string $url, string $tag = "response")
    {
        $response = $this->http->put(
            "/forms/" . $form . "/webhooks/" . $tag,
            [
                'json' => [
                    'url' => $url,
                    'enabled' => true,
                ]
            ]
        );
        return json_decode($response->getBody());
    }


    public function addHiddenFields(Form $form, $fields)
    {
        $form->addHiddenFields($fields);

        $response = $this->http->put(
            "/forms/" . $form->id,
            [
              'json' => (array) $form->getRaw(),
            ]
        );
    }

    public function updateForm(string $formId, array $json)
    {
        $this->http->put('/forms/' . $formId, [
            RequestOptions::JSON => $json
        ]);
    }

    public function patchForm(string $formId, array $json)
    {
        $this->http->patch('/forms/' . $formId, [
            RequestOptions::JSON => $json
        ]);
    }

    /**
     * Parse incoming webhook
     */
    public static function parseWebhook($json)
    {
        return new WebhookResponse($json);
    }
}
