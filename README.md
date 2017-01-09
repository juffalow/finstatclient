# FinStat PHP Client

API client for [FinStat](http://finstat.sk/api) service.

## Example

```
<?php

require __DIR__ . '/vendor/autoload.php';

$client = new juffalow\finstatclient\Client('<your api key>', '<your private key>');

try {
    $detail = $client->getCompanyDetail('35757442');
} catch(\Exception $e) {
    switch($e->getCode()) {
        case 28:
            // timeout
            break;
        case 402:
            // exceeding the daily limit
            break;
        case 403:
            // unauthorized ( bad API key / private key, ... )
            break;
        case 404:
            // ICO not found in database
            break;
    }
}
```
