# FinStat PHP Client

API client for [FinStat](http://finstat.sk/api) service.

## Example

```
<?php

require __DIR__ . '/vendor/autoload.php';

$client = new juffalow\finstatclient\Client('<your api key>', '<your private key>', null, null);

$detail = $client->getCompanyDetail('35757442');

echo "<pre>";
print_r($detail);
echo "</pre>";
```
