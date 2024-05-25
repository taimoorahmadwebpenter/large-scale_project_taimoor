<?php
// Include necessary files and establish database connection
include 'inc/helpers.php';

// Check connection


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // Prepare the SQL statement to delete a record from tbl_roles
    $sql = "DELETE FROM `tbl_roles` WHERE id=$id";

    // Exe the SQL statement
    if ($conn->query($sql) === TRUE) {
        // Redirect to roles.php after successful deletion
        header('location: roles.php');
        exit;
    } else {
        // If deletion fails, display an error message
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // If no 'id' parameter is provided, display a message
    echo "No ID provided for deletion.";
}

// Close the database connection

?>
