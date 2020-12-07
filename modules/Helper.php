<?php

function _safe($binding)
{
    return strip_tags(trim($binding));
}

function readJSON($path)
{
    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}


function createFile($string, $path)
{
    $create = fopen($path, "w") or die("Change your permision folder for application and harviacode folder to 777");
    fwrite($create, $string);
    fclose($create);
    
    return $path . ' - '. date('Y-m-d H:i:s');
}

function label($str)
{
    $label = str_replace('_', ' ', $str);
    $label = ucwords($label);
    return $label;
}
?>