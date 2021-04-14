<?php

namespace PtsTaiwan\LaravelNewebpaySDK\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \PtsTaiwan\LaravelNewebpaySDK\NewebPayMPG payment(string $no, int $amt, string $desc, string $email) 付款
 * @method static mixed decode(string $encryptString)
 *
 * @see \PtsTaiwan\LaravelNewebpaySDK\NewebPay
 */
class NewebPay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \PtsTaiwan\LaravelNewebpaySDK\NewebPay::class;
    }
}
