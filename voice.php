<?php

// @is_false
if (!is_null($voice)) {
  
  $getFile = $bot->getFile([
    'file_id' => $fileId])['result']['file_path'];
    
copy("https://api.telegram.org/file/bot. API_KEY . "/" . $getFile", 'voice.ogg');
            
 $Fields = [
   'id' => time(), 
   'offset' => 0, 
   'voice' => new CURLFile('voice.ogg')
   ];
   
    $target = 'https://ahapi.site/app-api/voice-search';
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $target);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($handle, CURLOPT_POST, 1);
	  curl_setopt($handle, CURLOPT_POSTFIELDS, $Fields);
	  curl_setopt($handle, CURLOPT_SAFE_UPLOAD, 1);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');
    
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
    
   $get = json_decode($result);
   $track_id = $get->track->id;
   $track_url = $get->track->url;
   
   unlink('voice.ogg');
   
  $track_file = arify("https://ahapi.site/app-api/tracks/$track_id/file",['url' => $track_url]);
  
if (!empty($track_file->file)) {
  $bot->sendAudio(['chat_id' => $chatId, 'audio' => $track_file->file]);
  // @is_false
  
} else {
  $bot->sendMessage(['chat_id' => $chatId, 'text' => 'Oops!']);
}
}

        