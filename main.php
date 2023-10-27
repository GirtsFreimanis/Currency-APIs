<?php

declare(strict_types=1);

require_once "vendor/autoload.php";

use App\FastForex;
use App\FreeCurrency;

$baseCurrency = trim(strtoupper(readline("enter base currency> ")));
$amount = (int)readline("enter amount> ");
$targetCurrency = trim(strtoupper(readline("enter target currency> ")));

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$freeCurrency = new FreeCurrency($baseCurrency, $targetCurrency);
echo $freeCurrency->getUrl() . "\n";
echo "exchange rate: " . $freeCurrency->getRate() . "\n";
echo "$amount $baseCurrency converts to " . $amount * $freeCurrency->getRate() . " $targetCurrency";
echo "\n" . str_repeat("=", 30) . "\n";

$fastForex = new FastForex($baseCurrency, $targetCurrency);

echo $fastForex->getUrl() . "\n";
echo "exchange rate: " . $fastForex->getRate() . "\n";
echo "$amount $baseCurrency converts to " . $amount * $fastForex->getRate() . " $targetCurrency";
echo "\n" . str_repeat("=", 30) . "\n";
if ($fastForex->getRate() > $freeCurrency->getRate()) {
    echo "recommended: " . $freeCurrency->getUrl();
} else {
    echo "recommended: " . $fastForex->getUrl();
}