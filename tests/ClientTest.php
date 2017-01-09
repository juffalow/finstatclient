<?php

use PHPUnit\Framework\TestCase;

use juffalow\finstatclient\Client;

class ClientTest extends TestCase {
    /**
     * Test verification hash generation
     */
    public function testVerificationHash() {
        $client = new Client('testapikey', 'testprivatekey');

        $this->assertEquals('2e3ca0205b5971c0b12a320a506c5efb7638fda6fd9d62b5cdc6435e372bbd50', $this->invokeMethod($client, 'getVerificationHash', array('123456789')));
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
