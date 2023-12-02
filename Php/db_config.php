<?php
// db_config.php

$host = "localhost"; // MySQL Database host
$mysqlUsername = "root"; // MySQL Database username
$mysqlPassword = ""; // MySQL Database password
$mysqlDatabase = "login-system"; // MySQL Database name

// Create a new MySQLi object
$mysqli = new mysqli($host, $mysqlUsername, $mysqlPassword, $mysqlDatabase);

// Check the MySQL connection
if ($mysqli->connect_error) {
    die("MySQL Connection failed: " . $mysqli->connect_error);
}

// You can optionally set the character set
$mysqli->set_charset("utf8mb4");

// Function to sanitize user inputs for MySQL
function sanitizeMySQLInput($data) {
    global $mysqli; // Make $mysqli accessible inside the function
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    // Use real_escape_string to prevent SQL injection
    $data = $mysqli->real_escape_string($data);

    return $data;
}

// MongoDB Configuration
$mongoUsername = "harikarumuri1086"; // MongoDB Database username
$mongoPassword = "6lVmwOGdG9mcnfvd"; // MongoDB Database password
$mongoDatabase = "mydatabase"; // MongoDB Database name

// Connect to MongoDB
try {
    $mongoClient = new MongoDB\Client(
        "mongodb+srv://$mongoUsername:$mongoPassword@cluster0.a50ieyu.mongodb.net/$mongoDatabase"
    );

    // Select MongoDB database
    $mongoDB = $mongoClient->$mongoDatabase;
} catch (Exception $e) {
    die("MongoDB Connection failed: " . $e->getMessage());
}

// Function to sanitize user inputs for MongoDB
function sanitizeMongoDBInput($data) {
    // Implement MongoDB-specific sanitation if needed
    // For example, you might want to use filters provided by the MongoDB extension
    // Ensure that the data is safe for MongoDB queries
    return $data;
}

// Function to insert user registration data into MySQL
function registerUserInMySQL($username, $password) {
    global $mysqli;

    // Sanitize inputs
    $username = sanitizeMySQLInput($username);
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into MySQL
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = $mysqli->query($query);

    return $result;
}

// Function to insert user profile data into MongoDB
function saveUserProfileInMongoDB($username, $age, $dob, $contact) {
    global $mongoDB;

    // Sanitize inputs
    $username = sanitizeMongoDBInput($username);
    $age = sanitizeMongoDBInput($age);
    $dob = sanitizeMongoDBInput($dob);
    $contact = sanitizeMongoDBInput($contact);

    // Insert data into MongoDB
    $collection = $mongoDB->selectCollection('user_profiles');
    $document = [
        'username' => $username,
        'age' => $age,
        'dob' => $dob,
        'contact' => $contact
    ];

    $collection->insertOne($document);
}

?>
