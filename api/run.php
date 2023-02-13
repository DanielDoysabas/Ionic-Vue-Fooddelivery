<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.paymongo.com/v1/payment_methods', [
  'headers' => [
    'Content-Type' => 'application/json',
    'accept' => 'application/json',
    'authorization' => 'Basic OlBAc3N3MHJkQDIwMjA=',
  ],
]);

echo $response->getBody();