<?php
namespace WATR\Iterators;

use GuzzleHttp\Client;
use Iterator;

class AfterIterator implements Iterator
{
    protected $client;
    protected $endpoint;
    protected $params;
    protected $classType;
    protected $position;
    protected $response;
    protected $requestDelayMs;
    protected $lastItemToken;
    public $page;
    public $total_items;
    public $error;

    public function __construct(Client $client, string $endpoint, array $params, $classType, int $requestDelayMs = 1000) {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->params = $params;
        $this->classType = $classType;
        $this->requestDelayMs = $requestDelayMs;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        $current = current($this->response);
        $this->lastItemToken = $current->token;
        return new $this->classType($current);
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $next = next($this->response);
        if ($next === false) {
            usleep( $this->page > 1 ? $this->requestDelayMs : 0 );
            $before = $this->lastItemToken !== null ? ['before' => $this->lastItemToken] : [];
            $options = [
                'query' => array_merge($this->params, $before)
            ];
            $rawResponse = $this->client->get($this->endpoint, $options);
            $response = json_decode($rawResponse->getBody());
            $this->total_items = $response->total_items;
            $this->response = $response->items;
        }
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return !empty(current($this->response));
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->response = [];
        $this->position = 0;
        $this->page = 0;
        $this->next();
        $this->lastItemToken = null;
    }
}