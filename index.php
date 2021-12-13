<?php

error_reporting(E_ALL);

/*
* Author: Aref
* Telegram: @isDown
* Version: 1
*/

const API_KEY = 'TOKEN';

function req($method, $data = []) {
    $api = 'https://api.telegram.org/bot'.API_KEY.'/'.$method;
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $api);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
    $result = json_decode(curl_exec($handle));
    curl_close($handle);
    return $result;
}

$update = json_decode(file_get_contents('php://input'));
$chatId = $update->message->chat->id;
$Text = $update->message->text;
$isVoice = $update->message->voice;
$fileId = $update->message->voice->file_id;

if (preg_match('/^[\/\#\!\.]?(start)$/si', $Text)) {
  $content = ['chat_id' => $chatId, 'text' => '• Send your voice ...'];
  req('sendMessage', $content);
}

if (!is_null($isVoice)) {
  $content = ['file_id' => $fileId];
  $getFile = req('getFile', $content)->result->file_path;
  
copy('https://api.telegram.org/file/bot'.API_KEY.'/'.$getFile,'voice.ogg');

if (file_exists('voice.ogg')) {
            
 $Fields = ['id' => time(), 'offset' => 0, 'voice' => new CURLFile('voice.ogg')];
   
    $target = 'https://ahapi.site/app-api/voice-search';
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $target);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_POST, 1);
	  curl_setopt($handle, CURLOPT_POSTFIELDS, $Fields);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');
    $headers = [
     'Accept: application/json, text/plain, */*',
     'X-Mobile-App-Version: 1.7.3',
     'X-Mobile-App-Market: google-play',
     'user-agent: Ahangify Mobile/1.7.3 (Samsung SM-A217F, Android 11 "30")',
     'X-Language: en',
     'authorization:Bearer '.file_get_contents('auth.txt')
     ];
    
    curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($handle));
    curl_close($handle);
    
   $track_id = $result->track->id;
   $track_url = $result->track->url;
   
   function get($url,$data = []) {
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
    
    $headers = [
     'Accept: application/json, text/plain, */*',
     'X-Mobile-App-Version: 1.7.3',
     'X-Mobile-App-Market: google-play',
     'user-agent: Ahangify Mobile/1.7.3 (Samsung SM-A217F, Android 11 "30")',
     'X-Language: en',
     'authorization:Bearer '.file_get_contents('auth.txt')
     ];
     
    curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($handle));
    curl_close($handle);
    return $result;
}
   unlink('voice.ogg');
   
  $param = ['url' => $track_url];
  $track_file = get("https://ahapi.site/app-api/tracks/$track_id/file", $param);
  
if (!empty($track_file->file)) {
  $content = ['chat_id' => $chatId, 'audio' => $track_file->file];
  req('sendAudio',$content);
} else {
  $content = ['chat_id' => $chatId, 'text' => 'Oops!'];
  req('sendMessage',$content);
}
}
}

/*
* Author: Aref
* Telegram: @isDown
* Version: 1
*/
