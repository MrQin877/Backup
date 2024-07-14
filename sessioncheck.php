<?php
session_start();
header('Content-Type: application/json');

$response = [];

if (isset($_SESSION['username'])) {
    $response['loggedIn'] = true;
    $response['user_id'] = $_SESSION['username'];
    $response['isAdmin'] = $_SESSION['username'] == 'admin'; 
} else {
    $response['loggedIn'] = false;
    $response['isAdmin'] = false;
}
// password:smartstudy1507@sport gmail: admin1507@smartstudysport.com
echo json_encode($response);
?>