<?php

namespace Framework;

class Helper
{
    static  public  function requestReplace($search, $replace, $str) {
        return trim(str_replace($search, $replace, $str));
    }
}