<?php


namespace App\Service\ExternalAPI;

use App\Exception\FooTrip\InvalidParameterException;
use App\Exception\MovieDB\FooTripResponseException;

interface FooTripAPIInterface
{
    /**
     * Get all destinations from Foo Trip Gateway (I suppose that Foo Trip is an external API)
     *
     * @param int $offset
     * @return array
     * @throws FooTripResponseException when there is a Foo Trip API unhandled error
     * @throws InvalidParameterException if there is an invalid input function parameter
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getAllDestinations(int $offset = 0): array;
}