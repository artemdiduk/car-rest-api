<?php

namespace Framework\Api;

Interface ApiInterface
{
    public function getHeaderJson($replace, $status);

    public  function jsonGet($data);

    public function getRequestReceptionJson();


}