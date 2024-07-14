<?php
require 'database.php';

$token = $_POST['token'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$db = getDbConnection();

$stmt = $db->prepare("SELECT * FROM password_resets WHERE token = ?");
$stmt->execute([$token]);
$resetRequest = $stmt->fetch();

if ($resetRequest && strtotime($resetRequest['created_at']) > strtotime('-1 hour')) {
    $stmt = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$password, $resetRequest['email']]);

    $stmt = $db->prepare("DELETE FROM password_resets WHERE email = ?");
    $stmt->execute([$resetRequest['email']]);

    echo "パスワードがリセットされました。";
} else {
    echo "トークンが無効です。再度リクエストしてください。";
}
?>
