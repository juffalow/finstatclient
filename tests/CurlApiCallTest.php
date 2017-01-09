<?php

use PHPUnit\Framework\TestCase;

use juffalow\finstatclient\CurlApiCall;

class CurlApiCallTest extends TestCase {
    /**
     * Test XML parsing
     */
    public function testParseXML() {
        $curlApiCall = new CurlApiCall();

        $xml = "<?xml version='1.0' encoding='UTF-8'?><test><hello>World</hello></test>";

        $helloWorld = $this->invokeMethod($curlApiCall, 'parseXML', array($xml));

        $this->assertEquals('World', $helloWorld->hello);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array()) {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
