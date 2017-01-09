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
            throw new Exception("API Error!", $httpCode);
        }

        return $response;
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
