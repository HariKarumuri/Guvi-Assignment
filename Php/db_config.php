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


?>
