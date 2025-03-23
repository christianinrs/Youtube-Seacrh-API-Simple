<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text_yt = urlencode($_POST['textnya']);
    $url_server = "https://api.paxsenix.biz.id/yt/search?q=".$text_yt;

    $ch = curl_init($url_server);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($result && isset($result['results'])) {
        $_SESSION['api_data'] = $result;
    } else {
        $_SESSION['error'] = "Gagal Mendapatkan Data";
    }

    header("Location: /");
    exit;
}
?>
