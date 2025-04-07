<?php

namespace Tykfyr\Ntfy\Tests;

use PHPUnit\Framework\TestCase;
use Tykfyr\Ntfy\Client;

class ClientTest extends TestCase
{
    public function testInstantiation()
    {
        $client = new Client('my-test-topic');
        $this->assertInstanceOf(Client::class, $client);
    }

    public function testSendReturnsBoolean()
    {
        $client = new Client('my-test-topic');
        $result = $client->send('Test message from PHPUnit');
        $this->assertIsBool($result);
    }
}