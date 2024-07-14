<?php


namespace App\Service\ExternalAPI;

use App\Exception\FooTrip\InvalidParameterException;
use App\Exception\MovieDB\FooTripResponseException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FooTripAPI implements FooTripAPIInterface
{
    private HttpClientInterface $httpClient;
    private string $foo_trip_url;

    public function __construct(HttpClientInterface $httpClient, string $foo_trip_url)
    {
        $this->httpClient = $httpClient;
        $this->foo_trip_url = $foo_trip_url;
    }

    public function getAllDestinations(int $offset = 0): array
    {
        if ($offset < 0) {
            throw new InvalidParameterException("The following parameter should be greater than 0: " . $offset);
        }

        try {
            $response = $this->httpClient->request(
                'GET', "{$this->foo_trip_url}/api/destinations?" . http_build_query(['offset' => $offset])
            );
            $data = $response->toArray();
        } catch (\Exception $exception) {
            throw new FooTripResponseException($exception);
        }

        return $data;
    }

}