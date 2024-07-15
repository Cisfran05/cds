<?php
// Telegram Bot API Token
$botToken = '6999104960:AAE49SYl3Ys_jkXIzfmp5el0DXfXjbmRA4w';
//$botToken = '7457318200:AAGklw5cPix9BFxPDO6_f8fiEY2PjqXzvdU';
// Telegram Chat ID where you want to receive the messages
$chatID = '5358329332';

// Function to send message to Telegram bot
function sendMessageToTelegram($message) {
    global $botToken, $chatID;
    
    $telegramURL = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $postFields = array(
        'chat_id' => $chatID,
        'text' => $message
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramURL);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Get IP address and user agent from the server side
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';

// Format message with IP address and user agent
$message = "IP Address: {$ipAddress}\nUser Agent: {$userAgent}";

// Send message to Telegram bot
$response = sendMessageToTelegram($message);

if ($response === false) {
    echo "Failed to send message to Telegram bot.";
} else {
    echo "Message sent to Telegram bot successfully.";
}
?>
