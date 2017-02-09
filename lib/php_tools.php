<?php

function say($string) {
    echo $string . "\n";
}

function str_bool($input) {
    if(is_bool($input) == 'bool') {
        return $input ? 'true' : 'false';
    } elseif(is_string($input) == 'string') {
        if($input == 'true') {
            return true;
        } elseif($input == 'false') {
            return false;
        }
    }
    throw new Exception('input is not valid for string boolean conversion');
}