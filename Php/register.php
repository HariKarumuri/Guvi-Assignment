<?php
// signup.php

// Include the database configuration file
include_once 'db_config.php';

// Function to sanitize user inputs
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user inputs from the AJAX request
    $username = sanitizeInput($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Insert user data into MySQL using prepared statements
    $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Registration successful
        echo json_encode(['success' => true, 'message' => 'Registration successful.']);
    } else {
        // Registration failed
        echo json_encode(['success' => false, 'message' => 'Registration failed.']);
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request is not a POST request, redirect to the signup page
    header('Location: signup.html');
}
?>
