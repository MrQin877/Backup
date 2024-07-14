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

// Upload to database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $content = $_POST['content'];

    if (empty($username) || empty($content)) {
        die("Username or content cannot be empty.");
    }

    $stmt = $conn->prepare("INSERT INTO testimony (username, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $content);
    if (!$stmt->execute()) {
        die("Error: " . $stmt->error);
    }
    $stmt->close();
}

$conn->close();
?>