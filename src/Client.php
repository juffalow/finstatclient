<?php

namespace juffalow\finstatclient;

/**
 *
 *
 * @author Matej 'juffalow' Jellus <juffalow@juffalow.com>
 */
class Client {
    const API_BASE_PATH = 'http://www.finstat.sk/api';
    /**
     * Unique key
     * @var string
     */
    protected $apiKey;
    /**
     * Private key for auth
     * @var string
     */
    protected $privateKey;
    /**
     *
     * @var string
     */
    protected $stationId;
    /**
     *
     * @var string
     */
    protected $stationName;
    /**
     *
     * @var ApiCallInterface
     */
    protected $apiCall;

    /**
     *
     * @param string $apiKey
     * @param string $privateKey
     * @param string $stationId
     * @param string $stationName
     */
    public function __construct($apiKey, $privateKey, $stationId, $stationName) {
        $this->apiKey = $apiKey;
        $this->privateKey = $privateKey;
        $this->stationId = $stationId;
        $this->stationName = $stationName;

        $this->apiCall = new CurlApiCall();
    }

    /**
     *
     * @param string ico
     * @return object
     */
    public function getCompanyDetail($ico) {
        $params = array(
            'Ico' => $ico,
            'apiKey' => $this->apiKey,
            'Hash' => $this->getVerificationHash($ico)
        );

        return $this->apiCall->call(self::API_BASE_PATH . '/detail', $params);
    }

    /**
     *
     * @param string $hashParam
     * @return string
     */
    protected function getVerificationHash($hashParam) {
        return hash('sha256', "SomeSalt+{$this->apiKey}+{$this->privateKey}++{$hashParam}+ended");
    }
}
