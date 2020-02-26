<?php


namespace App\currencyconverter;
use App\CallApis;

class CurrencyConverter extends CallApis
{
    //private $key = "51001ac437bcc5231685cbc156abae88";
    private $key = "0a68a651467c93c81883b611b01a4d02";

    function getCurrency($base, $symbols = 'XOF'){

        //$endpoints = "http://data.fixer.io/api/latest?access_key={$this->key}&base={$base}&symbols=$symbols";
        $endpoints = "http://api.currencylayer.com/live?access_key={$this->key}&source={$base}&currencies=$symbols&format=1";

        return $this->callApi($endpoints);
    }
}