
<?php


    include 'inc/head.php';
    
    if(isset($_GET['search']))
    {
        $filtervalue = $_GET['search'];
        $filterdata = "SELECT picture_url, fname, lname,email,tbl_roles.name FROM tbl_users 
        INNER JOIN tbl_roles ON tbl_users.id = tbl_roles.id
        INNER JOIN tbl_images ON tbl_images.imageable_id = tbl_users.id 
        WHERE tbl_images.imageable_type = 'user' AND CONCAT(fname,lname,email,name) LIKE '%$filtervalue%' ";
        $filterdata_run = runRawSql1($filterdata );

        if(isset($_GET['search'])) 
        {
            if(mysqli_num_rows($filterdata_run) > 0)
            {
            ?>
            <?php
            }
        }    
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
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
        <h1>Users</h1>
    </div><!-- .dashboard-page-title -->

    <?php include 'inc/dashboard/dashboard-side-menu-admin.php';?>

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
                                        <div class="mt-10">
                                            <a class="btn btn-primary btn-slim" href="users.php?role=all">All</a>
                                            <a class="btn btn-primary btn-slim" href="users.php?role=host">Hosts</a>
                                            <a class="btn btn-primary btn-slim" href="users.php?role=guest">Guests</a>
                                            <a class="btn btn-primary btn-slim" href="users.php?role=renter">Renters</a>
                                            <a class="btn btn-primary btn-slim" href="users.php?role=Manager">Manager </a>
                                        </div>
                                    </div>
                                    <div class="block-right">
                                        <div class="dashboard-form-inline mt-10">
                                            <form class="form-inline" method="GET" action="">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" name="search" placeholder="Search">
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-search-icon "><i class="homey-icon homey-icon-search-1" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
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
                                        <?php 
                                        if(!isset($_GET['search']))
                                        {
                                            include 'inc/dashboard/dashboard-admin-host-user.php'; 
                                        }
                                        else
                                        {
                                            while($row = mysqli_fetch_assoc($filterdata_run)) 
                                            { ?>
                                                <tr>
                                                    <td data-label="Avatar">
                                                        <img src=" <?php echo $row["picture_url"]; ?>" class="img-circle" alt="Image" width="40" height="40">
                                                    </td>
                                                    <td data-label="Name">
                                                        <?php echo $row["fname"]. ' ' .$row["lname"]; ?>
                                                    </td>
                                                    <td data-label="Email">
                                                        <?php echo $row["email"]; ?>
                                                    </td>
                                                    <td data-label="Role"><?php echo $row["name"]; ?></td>
                                                    <td data-label="Email Verification">
                                                        <span class="label label-success">VERIFIED</span>
                                                    </td>
                                                    <td data-label="ID Verification">
                                                        <span class="label label-warning">PENDING</span>
                                                    </td>
                                                    <td data-label="Actions">
                                                        <div class="custom-actions">
                                                            <button class="btn btn-success" onclick="window.location.href='dashboard-admin-host-user-detail.php'">Detail</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .block -->
                            <?php include 'inc/listing/pagination.php';?>
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