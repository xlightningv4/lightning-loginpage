<?php
session_start();

$discord_client_id = "CLIENTIDGIR";
$discord_client_secret = "SECRETIDGIR";
$discord_redirect_uri = "http://sitesismi.com/discord-callback.php"; 

if (!isset($_GET['code'])) {
    $auth_url = "https://discord.com/api/oauth2/authorize"
        . "?client_id=" . $discord_client_id
        . "&redirect_uri=" . urlencode($discord_redirect_uri)
        . "&response_type=code"
        . "&scope=identify%20email";

    header("Location: " . $auth_url);
    exit();
}
?>
