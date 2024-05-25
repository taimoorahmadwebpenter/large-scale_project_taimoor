<?php
include 'inc/head.php';

// Check connection
$message = $_POST['message'];

// Prepare an INSERT statement
$stmt = $conn->prepare("INSERT INTO tbl_messages (message) VALUES (?)");
$stmt->bind_param("s", $message); // "s" indicates the parameter is a string

// Execute the statement
if ($stmt->execute()) {
    echo "<script>alert('Record inserted successfully');</script>";
    header('location:dashboard-messages-detail.php');
} else {
    echo "Could not insert record: ". $stmt->error;
}

$stmt->close(); // Close the statement
?>





