<?php
// profile.php

// Include your MySQL database connection file
include 'db_config.php';
$userId = 1; // Replace with the actual user ID

// Include Redis
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$userSession = json_decode($redis->get("user_session:$userId"), true);

// Include MongoDB PHP library
require 'vendor/autoload.php';

// Connect to MongoDB
$mongoClient = new MongoDB\Client('mongodb://localhost:27017');

// Select the MongoDB database
$mongoDb = $mongoClient->selectDatabase('userprofiles');

// Select the MongoDB collection
$mongoCollection = $mongoDb->selectCollection('users');

// Fetch user profile details based on user ID
$profile = $mongoCollection->findOne(['user_id' => $userId], ['projection' => ['_id' => 0]]);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Return user profile details as JSON for GET requests
    echo json_encode($profile);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle POST requests for updating user profile
    $userId = $_POST['userId'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    // Use the updateOne method to update user profile details
    $updateResult = $mongoCollection->updateOne(
        ['user_id' => $userId],
        ['$set' => ['email' => $email, 'age' => $age]]
    );

    if ($updateResult->getModifiedCount() > 0) {
        // Return a success message
        echo "Profile updated successfully!";
    } else {
        // Return an error message if the profile update fails
        echo "Failed to update profile.";
    }
} else {
    // Handle other request methods
    http_response_code(400);
    echo "Invalid request.";
}
?>
