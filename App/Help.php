<?php

function site(string $param = null)
    {
        if($param && !empty(SITE[$param])){
            return SITE[$param];
        }

        return SITE["root"];
    }

function asset(string $path, $time = true): string
    {
        $file = SITE["root"] . "/assets{$path}";
        $fileOnDir = dirname(__DIR__) . "/assets/{$path}";

        if($time && file_exists($fileOnDir)){
            $file .= "?time=" . filemtime($fileOnDir);
        }

        return $file;
    }

function Mask($mask,$str){
    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;
}