<?php
require __DIR__ . "/vendor/autoload.php";

require_once "config.php";
include "db_conn.php";

$google = new Google\Client();

$google->setClientId("51478706271-r5sh6jitmar1as19l4j6v5m8rlb8pvge.apps.googleusercontent.com");
$google->setClientSecret("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");
$google->setRedirectUri("http://localhost/fyp/google.php");

if (!isset($_GET["code"])) {
    exit("Login failed");
}

$token = $google->fetchAccessTokenWithAuthCode($_GET["code"]);

$google->setAccessToken($token["access_token"]);

$oauth = new Google\Service\Oauth2($google);

$userinfo = $oauth->userinfo->get();

$email = $userinfo->email;
$username = $userinfo->name;
$status = "Unverified";

date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date("Y-m-d H:i:s");

try {
    $stmt = $conn->prepare("SELECT user_name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_name'] = $row['user_name'];
    } else {
        $stmt = $conn->prepare("INSERT INTO users (user_name, email,status,date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $status, $date);

        if ($stmt->execute()) {
            $_SESSION['user_name'] = $username;
        } else {
            throw new Exception("Error inserting user: " . $stmt->error);
        }
    }

    header("Location: users");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $stmt->close();
    $conn->close();
}
