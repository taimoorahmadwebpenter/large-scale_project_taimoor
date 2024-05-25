<?php 
include 'inc/helpers.php';

if(isset($_POST['Update_roles_btn'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
   

    $update_query = "UPDATE tbl_roles SET name=? WHERE id=?";
    
    // Prepare statement
    $stmt = mysqli_prepare($conn, $update_query);

    // Check for errors in preparing the statement
    if (!$stmt) {
        die('Error: ' . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "si", $name, $id);


    // Execute the statement
    $update_query_run = mysqli_stmt_execute($stmt);

    if($update_query_run) {
        $_SESSION['message'] = "Updated successfully";
        header('location: roles.php');
    } else {
        $_SESSION['message'] = "Not Updated";
        header('location: dashboard-admin-host-role-edit.php');
    }
}
?>
