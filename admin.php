<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head.php';?>
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
                            <?php include ('inc/header/account-host.php'); ?>
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
            <h1>Dashboard</h1>
        </div><!-- .dashboard-page-title -->

        <?php include 'inc/dashboard/dashboard-side-menu-admin.php';?>

        <div class="user-dashboard-right dashboard-without-sidebar">
            <div class="dashboard-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="dashboard-area admin-top-banner">

                                <div class="block">
                                    <div class="block-verify">
                                    <?php
// Assuming you have a connection object named $conn

$sql = "
    SELECT 
        (SELECT COUNT(*) FROM tbl_users) AS user_count,
        (SELECT COUNT(*) FROM tbl_properties) AS property_count,
        (SELECT COUNT(*) FROM tbl_reservations) AS reservation_count
";

$result = mysqli_query($conn, $sql); // Execute the query

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_count = $row["user_count"];
    $property_count = $row["property_count"];
    $reservation_count = $row["reservation_count"];
} else {
    $user_count = 0;
    $property_count = 0;
    $reservation_count = 0;
}

// Close the database connection if needed

?>
                                        <div class="block-col block-col-25 text-left">
                                            <h3>Listings</h3>
                                            <p class="block-big-text"><?php echo $property_count; ?></p>
                                            <div>2 New listings</div>
                                            <a class="btn btn-success-outlined btn-slim admin-top-banner-btn" href="#">Manage</a>
                                        </div>
                                        <div class="block-col block-col-25">
                                            <h3>Reservations</h3>
                                            <p class="block-big-text"><?php echo $reservation_count; ?></p>
                                            <div>21 New reservations</div>
                                            <a class="btn btn-success-outlined btn-slim admin-top-banner-btn" href="#">Manage</a>
                                        </div>
                                        <div class="block-col block-col-25">
                                            <h3>Users</h3>
                                            <p class="block-big-text"><?php echo $user_count; ?></p>
                                            <div>3 New Users</div>
                                            <a class="btn btn-success-outlined btn-slim admin-top-banner-btn" href="#">Manage</a>
                                        </div>
                                        <div class="block-col block-col-25">
                                            <h3>Earnings</h3>
                                            <p class="block-big-text">$87,672.00</p>
                                            <div>April, 2019</div>
                                            <a class="btn btn-success-outlined btn-slim admin-top-banner-btn" href="#">Details</a>
                                        </div>
                                    </div>
                                </div><!-- .block -->

                                <div class="block">
                                    <div class="block-title">
                                        <div class="block-left">
                                            <h2 class="title">New Listings</h2>
                                        </div>
                                        <div class="block-right">
                                            <a href="#" class="block-link pull-right">Manage <i cclass="homey-icon homey-icon-navigation-right-circle-1-interface-essential" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="table-block dashboard-listing-table dashboard-table">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Thumbnail</th>
                                                    <th>Address</th>
                                                    <th>ID</th>
                                                    <th>Type</th>
                                                    <th>Price</th>
                                                    <th>Bedrooms</th>
                                                    <th>Baths</th>
                                                    <th>Guests</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include 'inc/dashboard/dashboard-admin-listing-item-published.php';?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .block -->

                                <div class="block">
                                    <div class="block-title">
                                        <div class="block-left">
                                            <h2 class="title">Upcoming Reservations</h2>
                                        </div>
                                        <div class="block-right">
                                            <a href="#" class="block-link pull-right">View All <i cclass="homey-icon homey-icon-navigation-right-circle-1-interface-essential" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="table-block dashboard-reservation-table dashboard-table">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Thumbnail</th>
                                                    <th>ID</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Address</th>
                                                    <th>Check-in</th>
                                                    <th>Check-out</th>
                                                    <th>Guests</th>
                                                    <th>Pets</th>
                                                    <th>Subtotal</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php include 'inc/dashboard/dashboard-reservation-admin.php';?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .block -->



                                <div class="block">
                                    <div class="block-title">
                                        <div class="block-left">
                                            <h2 class="title">New Users</h2>
                                        </div>
                                        <div class="block-right">
                                            <a href="#" class="block-link pull-right">View All <i cclass="homey-icon homey-icon-navigation-right-circle-1-interface-essential" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="table-block dashboard-listing-table dashboard-table">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Email Verification</th>
                                            <th>ID Verification</th>
                                            <th>Actions</th>
                                        </tr>
                                            </thead>
                                            <tbody>
                                                <?php include 'inc/dashboard/dashboard-admin-host-user.php';?>
                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .block -->
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