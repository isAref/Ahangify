<?php

// @is_false
include 'Telegram.php';
define('API_KEY', '');

$bot = new Telegram('API_KEY');

$result = $bot->getData(); 
$text = $result['message']['text']; 
$chatId = $result['message']['chat']['id'];
$fromId = $result['message']['from']['id'];
$fileId = $result['message']['voice']['file_id'];
$voice = $result['message']['voice'];
// @is_false
include 'voice.php';
