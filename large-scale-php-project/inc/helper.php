<?php
session_start();
function connect_to_database($servername, $username, $password, $dbname) {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Return the connection object
    return $conn;
}

// Usage example:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental";

$conn = connect_to_database($servername, $username, $password, $dbname);


// echo "Connected successfully";
