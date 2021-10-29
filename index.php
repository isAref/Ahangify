<?php

include 'Telegram.php';
$bot = new Telegram('');

define('API_KEY', '');

$result = $bot->getData(); 
$text = $result['message']['text']; 
$chatId = $result['message']['chat']['id'];
$fromId = $result['message']['from']['id'];
$fileId = $result['message']['voice']['file_id'];
$voice = $result['message']['voice'];

include 'voice.php';
