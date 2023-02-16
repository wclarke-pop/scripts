<?php

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}


$urls = [
    'https://google.com'
];


foreach ($urls as $url) {
    //* $url = "https://www.popcreative.co.uk/";

    $handle = curl_init($url);
    
    curl_setopt_array($handle, [
        CURLOPT_RETURNTRANSFER => true
    ]);
    
    $response = curl_exec($handle);
    
    curl_close($handle);
    
    //* var_dump (str_contains($response, '<meta name="description" '));
    if (str_contains ($response, '<meta name="description" ')) echo "pass" . "<br>";
    else echo $url . "<br>";
}
