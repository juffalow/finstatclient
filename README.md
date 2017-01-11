# FinStat PHP Client

API client for [FinStat](http://finstat.sk/api) service.

## Example

This is basic example how to request for company detail.

```
<?php

require __DIR__ . '/vendor/autoload.php';

$client = new juffalow\finstatclient\Client('<your api key>', '<your private key>');

try {
    $detail = $client->getCompanyDetail('35757442');
} catch(\Exception $e) {
    print_r($e);
}
```

You can see more in [example page](/example/index.php).
