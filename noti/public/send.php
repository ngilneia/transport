<?php

use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\HttpHandler\HttpHandlerFactory;

require 'vendor/autoload.php';

$credential = new ServiceAccountCredentials(
  'https://www.googleapis.com/auth/firebase.messaging',
  json_decode(file_get_contents('pvKey.json'), true)
);

$token = $credential->fetchAuthToken(HttpHandlerFactory::build());

$ch = curl_init('https://fcm.googleapis.com/v1/projects/transport-1cfb0/messages:send');

curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
  'Authorization: Bearer ' . $token['access_token']
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, '{
    "message": {
      "token": "dxcN14g-WNhROehn-OskHC:APA91bHjiDa-MctZdXhnLX1T1WgB8rXtx0Jt71W9KZUGTi5s7aCEyP4CeUAxCKtvrKXL_z-yaq4MFNnUzrREDCY4CquhQBgV28FLrScOnvXyHRtjJSZbBjeTW7KFrfa2W6mtY-uP64BF",
      "notification": {
        "title": "Application Added",
        "body": "Application Added",
        "image": "https://cdn.shopify.com/s/files/1/1061/1924/files/Sunglasses_Emoji.png?2976903553660223024"
      },
      "webpush": {
        "fcm_options": {
          "link": "https://google.com"
        }
      }
    }
  }');

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "post");

$response = curl_exec($ch);

curl_close($ch);

echo $response;
