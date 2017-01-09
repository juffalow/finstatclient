<?php

namespace juffalow\finstatclient;

/**
 *
 *
 * @author Matej 'juffalow' Jellus <juffalow@juffalow.com>
 */
interface ApiCallInterface {
    /**
     *
     * @param string $url
     * @param array $params
     * @return object
     */
    public function call($url, $params);
}
