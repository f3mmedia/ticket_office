<?php

function say($string) {
    echo str_repeat('  ', $GLOBALS['indent']) . $string . "\n";
}

function format_string($string, $format) {
    $format = [
        'bold' => ['1', '0'],
        'underline' => ['4', '24'],
        'blue' => ['34', '0'],
        'green' => ['32', '0'],
        'grey' => ['37', '0'],
        'red' => ['31', '0'],
        'white' => ['30', '0']
    ][$format];

    return "\033[" . $format[0] . "m" . $string . "\033[" . $format[1] . "m";
}

function bold($string) {
    return format_string($string, 'bold');
}

function underline($string) {
    return format_string($string, 'underline');
}

function blue($string) {
    return format_string($string, 'blue');
}

function green($string) {
    return format_string($string, 'green');
}

function grey($string) {
    return format_string($string, 'grey');
}

function red($string) {
    return format_string($string, 'red');
}

function white($string) {
    return format_string($string, 'white');
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