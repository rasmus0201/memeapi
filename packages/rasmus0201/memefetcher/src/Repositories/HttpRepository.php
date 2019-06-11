<?php

namespace Bundsgaard\MemeFetcher\Repositories;

use GuzzleHttp\Client as GuzzleClient;

abstract class HttpRepository
{
    /**
     * @var GuzzleClient
     */
    private $guzzleClient;

    /**
     * Get the api url for the repository
     *
     *  @return string
     */
    abstract protected function getApiUrl();

    /**
     * Constructor
     *
     * @param GuzzleClient $guzzleClient
     */
    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * GET method for api
     *
     * @param string $url
     *
     * @return \stdClass
     */
    protected function get($url)
    {
        return $this->jsonFetch('GET', $url);
    }

    /**
     * Fetch JSON data by some HTTP method
     *
     * @param string $method
     * @param string $url
     *
     * @return \stdClass
     */
    private function jsonFetch($method, $url)
    {
        $response = $this->guzzleClient->request($method, $this->constructUrl($url));

        return $this->jsonResponse($response);
    }

    /**
     * Get JSON response from a Guzzle response stream
     *
     * @param \Psr\Http\Message\MessageInterface $response
     *
     * @return \stdClass
     */
    private function jsonResponse($response)
    {
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Get full api uri
     *
     * @param string $url
     *
     * @return string
     */
    private function constructUrl($url)
    {
        return rtrim($this->getApiUrl(), '/') . '/' . ltrim($url, '/');
    }
}
