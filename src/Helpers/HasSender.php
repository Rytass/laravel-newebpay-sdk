<?php

namespace PtsTaiwan\LaravelNewebpaySDK\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PtsTaiwan\LaravelNewebpaySDK\Contracts\HasHttp;
use PtsTaiwan\LaravelNewebpaySDK\Contracts\Sender;
use PtsTaiwan\LaravelNewebpaySDK\Sender\Async;
use PtsTaiwan\LaravelNewebpaySDK\Sender\Sync;

trait HasSender
{
    /**
     * The sender instance.
     *
     * @var \PtsTaiwan\LaravelNewebpaySDK\Contracts\Sender
     */
    protected $sender;

    /**
     * Set the sender instance.
     *
     * @param  \PtsTaiwan\LaravelNewebpaySDK\Contracts\Sender  $sender
     * @return self
     */
    public function setSender(Sender $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the sender instance.
     *
     * @return \PtsTaiwan\LaravelNewebpaySDK\Contracts\Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set sync sender.
     *
     * @return self
     */
    public function setSyncSender()
    {
        $this->setSender(new Sync());

        return $this;
    }

    /**
     * Set async sender.
     *
     * @return self
     */
    public function setAsyncSender()
    {
        $this->setSender(new Async($this->createHttp()));

        return $this;
    }

    /**
     * Set mock http instance.
     *
     * @param  \GuzzleHttp\Handler\MockHandler|array  $mockHandler
     * @return self
     */
    public function setMockHttp($mockResponse)
    {
        if ($this->sender instanceof HasHttp) {
            if (!$mockResponse instanceof MockHandler) {
                $mockHandler = new MockHandler($mockResponse);
            }

            $this->sender->setHttp($this->createHttp($mockHandler));
        }

        return $this;
    }

    /**
     * Create http instance.
     *
     * @param  \GuzzleHttp\Handler\MockHandler|null  $mockHttpHandler
     * @return \GuzzleHttp\Client
     */
    protected function createHttp($mockHttpHandler = null)
    {
        $attributes = [
            'handler' => $mockHttpHandler ? HandlerStack::create($mockHttpHandler) : null,
        ];

        $attributes = array_filter($attributes, function ($value) {
            return $value !== null;
        });

        return new Client($attributes);
    }
}
