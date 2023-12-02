<?php
// login.php

include_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeMySQLInput($_POST['username']); // Fix: Use sanitizeMySQLInput
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $dbUsername, $dbPassword);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
            // Login successful
            echo json_encode(['success' => true, 'message' => 'Login successful']);
            // You can set user session or perform other actions here
        } else {
            // Incorrect password
            echo json_encode(['success' => false, 'message' => 'Incorrect password']);
        }
    } else {
        // User not found
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }

    $stmt->close();
} else {
    // If the request is not a POST request, redirect to the login page
    header('Location: login.html');
}
?>
