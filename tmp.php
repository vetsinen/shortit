<?php
echo "3+3=".(3+3)."\n";

function isUrlDangerousWithVirusTotal($url, $apiKey) {
    $apiUrl = "https://www.virustotal.com/vtapi/v2/url/report?apikey={$apiKey}&resource=" . urlencode($url);

    $response = file_get_contents($apiUrl);
    if ($response === FALSE) {
        return "Error checking URL.";
    }

    $result = json_decode($response, true);

    if ($result['response_code'] === 1 && $result['positives'] > 0) {
        return true;
    } else {
        return false;
    }
}

$apiKey = "6ff2ba53b6e9931496f0824ac25f542378ed788f36a3f1ceb8eedd8903ad58e6"; // Replace with your VirusTotal API key
$urlToCheck = "http://testsafebrowsing.appspot.com/";

var_dump(isUrlDangerousWithVirusTotal($urlToCheck, $apiKey));