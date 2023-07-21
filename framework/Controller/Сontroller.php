<?php

namespace Framework\Controller;

abstract class Сontroller
{
    public  function render($data, $template) {

        $template = file_get_contents("view/{$template}");
        foreach ($data as $key => $value) {
            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        echo $template;
    }

    public  function renderApi($data) {
        echo $data;
    }


}