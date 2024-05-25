<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
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
        <h1>Roles update</h1>
    </div><!-- .dashboard-page-title -->

    <?php include 'inc/dashboard/dashboard-side-menu-admin.php';?>

    <div class="user-dashboard-right dashboard-without-sidebar">
        <div class="dashboard-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="dashboard-area">
                            <div class="block">
                                <div class="block-title ">
                                    <div class="block-left">
                                        <h2 class="title">Roles update</h2>
                                        <div class="mt-10">
                                            <a class="btn btn-primary btn-slim" href="dashboard-admin-users.php">All (30)</a>
                                            <a class="btn btn-primary btn-slim" href="dashboard-admin-all-guests.php">Hosts (5)</a>
                                            <a class="btn btn-primary btn-slim" href="dashboard-admin-all-hosts.php">Guests (25)</a>
                                        </div>
                                    </div>
                                    <div class="block-right">
                                        <div class="dashboard-form-inline mt-10">
                                            <form class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Search">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-search-icon"><i class="homey-icon homey-icon-search-1" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-block dashboard-listing-table dashboard-table py-5">
                                    <div class="col-md-4 d-flex justify-content-center"> <!-- Adjust the width as needed -->
                                        <div class="card text-center">
                                               
                                            <div class="card-body border-0">
                                                <?php
                                                if (isset($_GET['id'])) {
                                                    $id = $_GET['id'];
                                                    $fetch_query = "SELECT * FROM tbl_roles WHERE id='$id'";
                                                    $fetch_query_run = mysqli_query($conn, $fetch_query);

                                                    if (mysqli_num_rows($fetch_query_run) > 0) {
                                                        $row = mysqli_fetch_assoc($fetch_query_run);
                                                        ?>
                                                        <form action="dashboard-admin-host-roles-update.php" method="POST">
                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                            <div class="row pb-3">
                                                                <div class="col pb-3">
                                                                    <input type="text" name="name" value="<?php echo $row['name']; ?>"
                                                                           class="form-control" placeholder="name">
                                                                </div>
                                                            </div>
                                                            <div class="col text-center pb-3">
                                                                <button type="submit" name="Update_roles_btn" class="btn btn-success ">Update</button>
                                                            </div>
                                                        </form>
                                                        <?php
                                                    } else {
                                                        echo 'No data found';
                                                    }
                                                } else {
                                                    echo 'Something went wrong';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
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
