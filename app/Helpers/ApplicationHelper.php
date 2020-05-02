<?php

/**
 * Custome Helper Fucntion 
 *
 * @package :  Sidetheme
 * @author  :  Suraj Datheputhe
 */

// Random String Generator
function randomString($leng = 100) 
{
   	// Random String Function
    $chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    $str_len = strlen($chars);
    $random = '';
    for ($i=0; $i<$leng; $i++) {
        $random .= $chars[rand(0, $str_len-1)];
    }
    
    return $random;
}

// Active Page
function active($uri = '') {
    $active = '';
    if (Request::is(Request::segment(1) . '/' . $uri . '/*') || Request::is(Request::segment(1) . '/' . $uri) || Request::is($uri)) {
        $active = 'active';
    }
    return $active;
}