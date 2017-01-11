# FinStat PHP Client

API client for [FinStat](http://finstat.sk/api) service.

# Tech

This solution is using _CURL_. But if you have to use something else to make
HTTP POST, there is no problem to do that :

```
<?php

require __DIR__ . '/vendor/autoload.php';

class NonCurlApiCall extends \juffalow\finstatclient\CurlApiCall {
    protected function httpPost($url, $params) {
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($params)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if($result === false) {
            throw \Exception('Error!');
        }
        return $result;
    }
}

$client = new juffalow\finstatclient\Client('<your API key>', '<your private key>', null, null, new NonCurlApiCall());
```

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
