<?php

namespace App\Services;

class API{
    public function getData($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($ch);
        $err = curl_error($ch);
        if ($err) {
            return [];
        }
        curl_close ($ch);
        return $response;
    }
}
