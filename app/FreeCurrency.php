<?php

declare(strict_types=1);

namespace App;

class FreeCurrency
{
    private Conversion $conversion;
    const BASE_URL = "https://api.freecurrencyapi.com/v1/latest";
    const API_KEY_URL = "apikey";
    const BASE_CURRENCY_URL = "base_currency";
    const TARGET_CURRENCY_URL = "currencies";
    const RESULT_LOCATION = "data";
    private string $baseCurrency;
    private string $targetCurrency;
    private float $rate;

    public function __construct(
        string $baseCurrency,
        string $targetCurrency
    )
    {
        $this->baseCurrency = $baseCurrency;
        $this->targetCurrency = $targetCurrency;
        $this->conversion = new Conversion(
            $_ENV['FREE_CURRENCY_API_KEY'],
            self::BASE_URL,
            self::API_KEY_URL,
            self::BASE_CURRENCY_URL,
            self::TARGET_CURRENCY_URL
        );
        $this->rate = $this->conversion->convert(
            $this->baseCurrency,
            $this->targetCurrency,
            self::RESULT_LOCATION
        );
    }

    public function getUrl(): string
    {
        return self::BASE_URL;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}