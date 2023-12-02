<?php

require 'vendor/autoload.php';

use MongoDB\Client;

// Replace the following with your actual MongoDB connection string
$mongoConnectionString = 'mongodb+srv://harikarumuri1086:6lVmwOGdG9mcnfvd@cluster0.mongodb.net/<database>';

try {
    $mongoClient = new Client($mongoConnectionString);

    
    $mongoDB = $mongoClient->selectDatabase('mydatabase');

    echo 'Connected to MongoDB successfully';
} catch (Exception $e) {
    die('MongoDB Connection failed: ' . $e->getMessage());
}

?>
