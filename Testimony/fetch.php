<?php
session_start(); // Start the session to access session variables

$servername = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "sunnysmile"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure username is set in the session
if (!isset($_SESSION['username'])) {
    die("Username not set in session.");
}

// Fetch testimonies
$testimony_content = [];
$testimony_query = "SELECT username, content FROM testimony WHERE username = ?";
$stmt = $conn->prepare($testimony_query);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$testimony_result = $stmt->get_result();

while ($row = $testimony_result->fetch_assoc()) {
    $testimony_content[] = [
        'username' => $row['username'],
        'content' => $row['content']
    ];
}

echo json_encode(["testimony" => $testimony_content]);

$stmt->close();
$conn->close();
?>