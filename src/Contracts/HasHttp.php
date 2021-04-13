<?php

namespace PtsTaiwan\LaravelNewebpaySDK\Contracts;

use GuzzleHttp\Client;

interface HasHttp
{
    /**
     * Set mock http client instance.
     *
     * @param  \GuzzleHttp\Client  $client
     * @return self
     */
    public function setHttp(Client $client);
}
