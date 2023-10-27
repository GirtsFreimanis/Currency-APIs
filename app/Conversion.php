<?php

declare(strict_types=1);

namespace App;

class Conversion
{
    private string $apiKey;
    private string $baseUrl;
    private string $apiKeyUrl;
    private string $baseCurrencyUrl;
    private string $targetCurrencyUrl;

    public function __construct(
        string $apiKey,
        string $baseUrl,
        string $apiKeyUrl,
        string $baseCurrencyUrl,
        string $targetCurrencyUrl
    )
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
        $this->apiKeyUrl = $apiKeyUrl;
        $this->baseCurrencyUrl = $baseCurrencyUrl;
        $this->targetCurrencyUrl = $targetCurrencyUrl;
    }

    public function convert(
        string $baseCurrency,
        string $targetCurrency,
        string $resultLocation
    ): float
    {
        $url = $this->getUrl(
            $baseCurrency,
            $targetCurrency
        );
        $result = json_decode(file_get_contents($url));
        return $result->$resultLocation->$targetCurrency;
    }

    public function getUrl(
        string $baseCurrency,
        string $targetCurrency
    ): string
    {
        $params = [
            $this->apiKeyUrl => $this->apiKey,
            $this->baseCurrencyUrl => $baseCurrency,
            $this->targetCurrencyUrl => $targetCurrency
        ];
        return $this->baseUrl . "?" . http_build_query($params);
    }
}