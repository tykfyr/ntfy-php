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
     * @param string $message
     * @param array $options Optional ntfy headers (title, tags, priority, click, attach, etc.)
     * @return bool
     */
    public function send(string $message, array $options = []): bool
    {
        $body = array_merge([
            'message' => $message
        ], $options);

        try {
            $this->http->post($this->topic, [
                'json' => $body
            ]);
            return true;
        } catch (GuzzleException $e) {
            return false;
        }
    }
}