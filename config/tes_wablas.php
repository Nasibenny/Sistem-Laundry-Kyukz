<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$apiKey = '2jrONpYQpW1ITDGapCNn3KOpo3ULozx68EkA8kTZC6WTQ0TSZ7RTTWT';

$data = [
    'phone' => '081338371092',
    'message' => 'Tes Wablas OK'
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://bdg.wablas.com/api/send-message',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        'Authorization: ' . $apiKey,
        'Content-Type: application/json'
    ],
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Curl Error: ' . curl_error($curl);
}

curl_close($curl);

echo $response;
