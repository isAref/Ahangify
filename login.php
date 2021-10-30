<?php

// @is_false

$login = json_encode(['username' => 'UserName', 'password' => 'Password']);

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, 'https://ahapi.site/login');
curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($handle, CURLOPT_POST, 1);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($handle, CURLOPT_POSTFIELDS, $login);
curl_setopt($handle, CURLOPT_ENCODING,'gzip');

$headers = [];
$headers[] = 'Host: ahapi.site';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'X-Mobile-App-Version: 1.7.3';
$headers[] = 'X-Mobile-App-Market: google-play';
$headers[] = 'user-agent:Ahangify Mobile/1.7.3 (Samsung SM-A217F, Android 11 "30")';
$headers[] = 'X-Language: en';
$headers[] = 'Content-Type: application/json;charset=utf-8';
$headers[] = 'Content-Length: '.strlen($login);

curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
$result = json_decode(curl_exec($handle));
curl_close($handle);
file_put_contents('auth.txt', $result->access_token);
// @is_false
echo $result->access_token;
