<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head.php';?>
    <?php include 'inc\header\account-host.php';?>
</head>
<body>
    
    <div class="header-dashboard">
        <div class="nav-area header-type-1">
            <!-- desktop nav -->
            <header class="header-nav hidden-sm hidden-xs">
                <div class="container-fluid">
                    <div class="header-inner table-block">
                        <div class="header-comp-logo">
                            <?php include ('inc/header/logo.php'); ?>
                        </div>
                        <div class="header-comp-nav text-left">
                            <?php include ('inc/header/main-nav.php'); ?>
                        </div>
                        <div class="header-comp-right">
                            <?php include ('inc/header/login-register-v1.php'); ?>
                        </div>
                    </div>
                </div>
            </header>
            <!-- mobile header -->
            <?php include ('inc/header/header-mobile-full-width.php'); ?>    
        </div>   
    </div>
    <section id="body-area">

        <div class="dashboard-page-title">
            <h1>Messages</h1>
        </div><!-- .dashboard-page-title -->

        <?php include 'inc/dashboard/dashboard-side-menu-host.php';?>

        <div class="user-dashboard-right dashboard-without-sidebar">
            <div class="dashboard-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="dashboard-area">
                                <div class="block">
                                    <div class="block-title">
                                        <div class="block-left">
                                            <h2 class="title">Manage</h2>
                                        </div>
                                    </div>
                                    <?php
// Database connection
// $con = mysqli_connect("localhost", "username", "password", "myDatabase") or die(mysqli_error($con));

// Query to fetch messages
$query = "SELECT * FROM tbl_messages";
$result = runRawSql($conn, $query) or die("Query failed");

// Check if there are any messages to display
if (mysqli_num_rows($result) > 0) {
    // Loop through each message and display it within a div
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="block-body">'. htmlspecialchars($row['message']). '</div>';
    }
} else {
    echo '<div class="block-body">No messages found.</div>';
}
?>
                                </div>
                            </div><!-- .dashboard-area -->
                        </div><!-- col-lg-12 col-md-12 col-sm-12 -->
                    </div>
                </div><!-- .container-fluid -->
            </div><!-- .dashboard-content-area -->    
            
        </div><!-- .user-dashboard-right -->

    </section><!-- #body-area -->

    <?php // include 'inc/dashboard/dashboard-footer.php';?>
    <?php include 'inc/scripts.php';?>

</body>
</html>