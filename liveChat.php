<?php

require_once __DIR__ . '/vendor/autoload.php';

use LiveChat\Api\Client as LiveChat;

$LiveChatAPI = new LiveChat('%login%', '%apiKey%');
$agents = $LiveChatAPI->agents->get(); 

?>