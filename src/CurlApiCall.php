<?php

namespace juffalow\finstatclient;

/**
 *
 *
 * @author Matej 'juffalow' Jellus <juffalow@juffalow.com>
 */
class CurlApiCall implements ApiCallInterface {
    public function call($url, $params) {
        return $this->parseXML($this->httpPost($url, $params));
    }

    /**
     *
     * @param string $url
     * @param array $params
     * @throws Exception
     */
    protected function httpPost($url, $params) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);

        if($httpCode != 200) {
            throw new \Exception($this->getErrorMessage($httpCode), $httpCode);
        }

        return $response;
    }

    /**
     *
     * @param int $apiErrorCode
     * @return String error message based on API error code
     */
    protected function getErrorMessage($apiErrorCode) {
        switch((int) $apiErrorCode) {
            case 28:
                return "Timeout!";
            case 402:
                return "The daily limit has exceeded!";
            case 403:
                return "Unauthorized!";
            case 404:
                return "ICO not found!";
        }
        return "API error occured!";
    }

    /**
     *
     * @param string $str
     * @return object
     */
    protected function parseXML($str) {
        return simplexml_load_string((string) $str);
    }
}
