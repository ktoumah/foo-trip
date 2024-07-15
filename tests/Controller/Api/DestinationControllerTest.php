<?php

namespace App\Tests\Controller\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class DestinationControllerTest extends ApiTestCase
{
    public function testSomething(): void
    {
        $response = static::createClient()
            ->request('GET', "/api/destinations?" . http_build_query(['offset' => 0]))
            ->toArray()
        ;

        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('data', $response);
    }
}
