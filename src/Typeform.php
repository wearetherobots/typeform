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
        $body = json_decode($response->getBody()->getContents());
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
     * Delete form responses
     * 
     * @param string $formId id of the form
     * @param array $queryParams contains a key 'included_response_ids' that is a
     * comma-separated list of response_id values of the responses to delete
     */
    public function deleteResponses($formId, array $queryParams = [])
    {
        $response = $this->http->delete("/forms/" . $formId . "/responses", $queryParams);

        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode > 300) {
            throw new \Exception('Failed to delete responses, form_id: ' . $formId . ', query params :' . json_encode($queryParams));
        }

        return true;
    }


    /**
     * @param string $form_id
     * @param string $url
     * @param string|null $secret
     * @param string $tag
     * @return mixed
     */
    public function registerWebhook(string $form_id, string $url, string $secret = null, string $tag = "response")
    {
        $json = [
            'url' => $url,
            'enabled' => true,
        ];

        if ($secret !== null) {
            $json['secret'] = $secret;
        }

        $response = $this->http->put(
            "/forms/" . $form_id . "/webhooks/" . $tag,
            [
                'json' => $json
            ]
        );
        return json_decode($response->getBody());
    }

    /**
     * @param string $formId
     * @param string $tag
     * @return bool
     * @throws \Exception
     */
    public function unRegisterWebhook(string $formId, string $tag = "response")
    {
        $response = $this->http->delete("/forms/" . $formId . "/webhooks/" . $tag);

        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode > 300) {
            throw new \Exception('Failed to unregister webhook, form_id: ' . $formId . ', tag: ' . $tag);
        }

        return true;
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

    /**
     * @param array $json
     * @return Form
     */
    public function createForm(array $json)
    {
        $response = $this->http->post('/forms', [
            RequestOptions::JSON => $json
        ]);
        return new Form($response->getBody()->getContents());
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
     * Delete typeform by form id.
     * @param string $formId
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteForm(string $formId)
    {
        return $this->http->delete('/forms/' . $formId);
    }

    /**
     * Parse incoming webhook
     */
    public static function parseWebhook($json)
    {
        return new WebhookResponse($json);
    }

    public static function verifyWebhookResponse($receiverSignature, $body, $secret)
    {
        $actualSignature = 'sha256=' . base64_encode(hash_hmac('sha256', $body, $secret, true));
        return $receiverSignature === $actualSignature;
    }

    public static function encodeBody($body, $secret)
    {
        $actualSignature = 'sha256=' . base64_encode(hash_hmac('sha256', $body, $secret, true));
        return $actualSignature;
    }

}
