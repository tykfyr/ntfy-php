<?php

namespace Tykfyr\Ntfy;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class Client
{
    protected string $topic;
    protected string $baseUrl;
    protected ?string $auth;
    protected HttpClient $http;

    public function __construct(string $topic, array $options = [])
    {
        $this->topic = $topic;
        $this->baseUrl = rtrim($options['base_url'] ?? 'https://ntfy.sh', '/');
        $this->auth = $options['auth'] ?? null;

        $headers = [
            'Content-Type' => 'application/json'
        ];

        if ($this->auth) {
            $headers['Authorization'] = $this->auth;
        }

        $this->http = new HttpClient([
            'base_uri' => $this->baseUrl . '/',
            'headers' => $headers
        ]);
    }

    /**
     * Send a message to ntfy
     *
     * @param  string  $message
     * @param  array  $headers
     * @return bool
     */
    public function send(string $message, array $headers = []): bool
    {
        $defaultHeaders = [
            'Content-Type' => 'text/plain',
        ];

        $allHeaders = array_merge($defaultHeaders, $headers);

        try {
            $this->http->post($this->topic, [
                'headers' => $allHeaders,
                'body' => $message
            ]);
            return true;
        } catch (GuzzleException $e) {
            return false;
        }
    }
}