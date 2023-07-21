<?php

namespace Framework\Api;

class Api implements ApiInterface
{
    public function getHeaderJson($replace, $status) {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json', $replace, $status);
        return $this;
    }
    public  function jsonGet($data) {
        return json_encode($data);
    }

    public function getRequestReceptionJson() {
        $json = file_get_contents('php://input');
        return json_decode($json); 
    }


}