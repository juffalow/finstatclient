<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);

require __DIR__ . './../vendor/autoload.php';

$client = new juffalow\finstatclient\Client('<your API key>', '<your private key>', null, null);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>FinStat Client Example</title>
    </head>
    <body>
        <h2>Detail</h2>

        <pre>
            <?php
                try {
                    $detail = $client->getCompanyDetail('35757442');
                    print_r($detail);
                } catch(\Exception $e) {
                    print_r($e);
                }
             ?>
        </pre>

        <h2>Detail (extended)</h2>

        <pre>
            <?php
                try {
                    $detail = $client->getCompanyExtendedDetail('35757442');
                    print_r($detail);
                } catch(\Exception $e) {
                    print_r($e);
                }
             ?>
        </pre>

        <h2>Detail (utltimate)</h2>

        <pre>
            <?php
                try {
                    $detail = $client->getCompanyUltimateDetail('35757442');
                    print_r($detail);
                } catch(\Exception $e) {
                    print_r($e);
                }
             ?>
        </pre>

        <h2>Autocomplete</h2>

        <pre>
            <?php
                try {
                    $suggestions = $client->getSuggestions('Zľava');
                    print_r($suggestions);
                } catch(\Exception $e) {
                    print_r($e);
                }
             ?>
        </pre>
    </body>
</html>
