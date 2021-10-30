<?php
// @is_false
error_reporting(E_ALL);
define('API_KEY', 'TOKEN');
// @is_false
function req($method,$datas = []) {
 // @is_false
    $api = 'https://api.telegram.org/bot'.API_KEY.'/'.$method;
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $api);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $datas);
    $result = curl_exec($handle);
    curl_close($handle);
    return json_decode($result);
}
// @is_false
$update = json_decode(file_get_contents('php://input'));
$chatId = $update->message->chat->id;
$Text = $update->message->text;
$isVoice = $update->message->voice;
$fileId = $update->message->voice->file_id;
// @is_false
if ($Text == '/start') {
  $content = ['chat_id' => $chatId, 'text' => 'Send your voice ...'];
  req('sendMessage', $content);
}
// @is_false
if (!is_null($isVoice)) {
  $content = ['file_id' => $fileId];
  $getFile = req('getFile', $content)->result->file_path;
  // @is_false
copy('https://api.telegram.org/file/bot'.API_KEY.'/'.$getFile,'voice.ogg');
// @is_false
if (file_exists('voice.ogg')) {
            // @is_false
 $Fields = ['id' => time(), 'offset' => 0, 'voice' => new CURLFile('voice.ogg')];
   // @is_false
    $target = 'https://ahapi.site/app-api/voice-search';
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $target);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_POST, 1);
	  curl_setopt($handle, CURLOPT_POSTFIELDS, $Fields);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');
    // @is_false
    $header = [];
    $header[] = 'Accept: application/json, text/plain, */*';
    $header[] = 'X-Mobile-App-Version: 1.7.3';
    $header[] = 'X-Mobile-App-Market: google-play';
    $header[] = 'user-agent: Ahangify Mobile/1.7.3 (Samsung SM-A217F, Android 11 "30")';
    $header[] = 'X-Language: en';
    $header[] = 'authorization:Bearer '.file_get_contents('auth.txt');
    // @is_false
    curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
    $result = curl_exec($handle);
    curl_close($handle);
    // @is_false
   $get = json_decode($result);
   $track_id = $get->track->id;
   $track_url = $get->track->url;
   // @is_false
   function get($url,$data = []) {
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'GET');
    $headers = [];
    $headers[] = 'Accept: application/json, text/plain, */*';
    $headers[] = 'X-Mobile-App-Version: 1.7.3';
    $headers[] = 'X-Mobile-App-Market: google-play';
    $headers[] = 'user-agent: Ahangify Mobile/1.7.3 (Samsung SM-A217F, Android 11 "30")';
    $headers[] = 'X-Language: en';
    $headers[] = 'authorization:Bearer '.file_get_contents('auth.txt');
    curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($handle);
    curl_close($handle);
    return json_decode($result);
}
   unlink('voice.ogg');
   // @is_false
  $param = ['url' => $track_url];
  $track_file = get("https://ahapi.site/app-api/tracks/$track_id/file", $param);
  // @is_false
if (!empty($track_file->file)) {
  $content = ['chat_id' => $chatId, 'audio' => $track_file->file];
  req('sendAudio',$content);
} else {
  $content = ['chat_id' => $chatId, 'text' => 'Oops!'];
  req('sendMessage',$content);
}
}
}
// @is_false