<?php
session_start();

$discord_client_id = "CLIENTIDGIR";
$discord_client_secret = "SECRETIDGIR";
$discord_redirect_uri = "http://astronixservices.com/discord-callback.php";

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $token_url = "https://discord.com/api/oauth2/token";
    $data = [
        'client_id' => $discord_client_id,
        'client_secret' => $discord_client_secret,
        'code' => $code,
        'grant_type' => 'authorization_code',
        'redirect_uri' => $discord_redirect_uri,
        'scope' => 'identify email'
    ];

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HEADER, false);
    $response = curl_exec($ch);
    curl_close($ch);

    $token_info = json_decode($response, true);

    if (isset($token_info['access_token'])) {
        $_SESSION['access_token'] = $token_info['access_token'];

        $user_url = "https://discord.com/api/v10/users/@me";
        $headers = [
            'Authorization: Bearer ' . $token_info['access_token']
        ];

        $ch = curl_init($user_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $user_data = curl_exec($ch);
        curl_close($ch);

        $user_info = json_decode($user_data, true);


        header("Location: http://astronixservices.com");
        exit();
    } else {
        echo "Token alınamadı.";
    }
} else {
    echo "Geçersiz geri dönüş kodu.";
}
?>
