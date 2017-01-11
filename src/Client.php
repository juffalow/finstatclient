<?php

namespace juffalow\finstatclient;

use juffalow\finstatclient\ApiCallInterface;

/**
 *
 *
 * @author Matej 'juffalow' Jellus <juffalow@juffalow.com>
 */
class Client {
    const API_BASE_PATH = 'http://www.finstat.sk/api/';

    const REQUEST_DETAIL = 'detail';

    const REQUEST_EXTENDED = 'extended';

    const REQUEST_ULTIMATE = 'ultimate';
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
    public function __construct($apiKey, $privateKey, $stationId = null, $stationName = null, ApiCallInterface $apiCall = null) {
        $this->apiKey = $apiKey;
        $this->privateKey = $privateKey;
        $this->stationId = $stationId;
        $this->stationName = $stationName;

        $this->apiCall = $apiCall !== null ? $apiCall : new CurlApiCall();
    }

    /**
     *
     * @param string $ico company ICO
     * @return object
     * @throws \Exception
     */
    public function getCompanyDetail($ico) {
        return $this->fetchCompanyDetail($ico, self::REQUEST_DETAIL);
    }

    /**
     *
     * @param string $ico company ICO
     * @return object
     * @throws \Exception
     */
    public function getCompanyExtendedDetail($ico) {
        return $this->fetchCompanyDetail($ico, self::REQUEST_EXTENDED);
    }

    /**
     *
     * @param string $ico company ICO
     * @return object
     * @throws \Exception
     */
    public function getCompanyUltimateDetail($ico) {
        return $this->fetchCompanyDetail($ico, self::REQUEST_ULTIMATE);
    }

    /**
     *
     * @param string $ico company ICO
     * @param string $requestType REQUEST_DETAIL or REQUEST_EXTENDED or REQUEST_ULTIMATE
     * @return object
     * @throws \Exception
     */
    protected function fetchCompanyDetail($ico, $requestType = self::REQUEST_DETAIL) {
        $params = array(
            'Ico' => $ico,
            'apiKey' => $this->apiKey,
            'Hash' => $this->getVerificationHash($ico)
        );

        return $this->apiCall->call(self::API_BASE_PATH . $requestType, $params);
    }

    /**
     *
     * @param string $hashParam
     * @return string
     */
    protected function getVerificationHash($hashParam) {
        return hash('sha256', "SomeSalt+{$this->apiKey}+{$this->privateKey}++{$hashParam}+ended");
    }

    /**
     *
     * @param string $query
     * @return object
     * @throws \Exception
     */
    public function getSuggestions($query) {
        $params = array(
            'query' => $query,
            'apiKey' => $this->apiKey,
            'Hash' => $this->getVerificationHash($query)
        );

        return $this->apiCall->call(self::API_BASE_PATH . 'autocomplete', $params);
    }
}
