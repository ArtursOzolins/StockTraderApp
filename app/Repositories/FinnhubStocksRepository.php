<?php

namespace App\Repositories;

use Finnhub\Api\DefaultApi;
use Finnhub\Configuration;
use GuzzleHttp\Client;

class FinnhubStocksRepository implements StocksRepository
{
    private DefaultApi $client;

    public function __construct(DefaultApi $client)
    {
        $this->client = $client;
    }

    public function getDataByName(string $companyName)
    {
        if(cache()->has($companyName))
        {
            $symbol = cache()->get($companyName);
        } else {
            $symbol = $this->client->symbolSearch($companyName)->getResult()[0]->getSymbol();
            cache()->put($companyName, $symbol, now()->addDay());
        }

        if(cache()->has($symbol))
        {
            $general = cache()->get($symbol);
        } else {
            $general = $this->client->companyProfile2($symbol);
            cache()->put($symbol, $general);
        }

        $prices = $this->client->quote($symbol);

        $data['symbol'] = $symbol;
        $data['name'] = $general->getName();
        $data['logo'] = $general->getLogo();
        $data['country'] = $general->getCountry();
        $data['currency'] = $general->getCurrency();
        $data['currentPrice'] = $prices->getC();
        $data['highPrice'] = $prices->getH();
        $data['lowPrice'] = $prices->getL();
        $data['openPrice'] = $prices->getO();

        return $data;
    }
}
