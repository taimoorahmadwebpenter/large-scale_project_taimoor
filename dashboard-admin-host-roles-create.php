<?php 
include('inc/helpers.php');

if(isset($_POST['add_role_btn'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
   

    // Hash the password
    

    $register_query = "INSERT INTO tbl_roles (name, description) VALUES ('$name', '$description')";
    
    // Prepare statement
    $stmt = mysqli_prepare($conn, $register_query);

    // Check for errors in preparing the statement
    if (!$stmt) {
        die('Error: ' . mysqli_error($conn));
    }

    // Bind parameters
    // $bind_result = mysqli_stmt_bind_param($stmt,  $first_name, $last_name, $email, $password, $confirm_password,  $gender, $termscond);

    // Check for errors in binding parameters
    // if (!$bind_result) {
    //     die('Error in binding parameters: ' . mysqli_stmt_error($stmt));
    // }

    // Execute the statement
    $execute_result = mysqli_stmt_execute($stmt);

    // Check for errors in executing the statement
    if (!$execute_result) {
        die('Error in executing the statement: ' . mysqli_stmt_error($stmt));
    }

    // Registration successful, redirect to login page
    header('location: roles.php');
    exit(); // Stop further execution
}
?>
