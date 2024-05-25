<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'inc/head.php'; ?>
</head>

<body>

    <div class="header-dashboard">
        <div class="nav-area header-type-1">
            <!-- desktop nav -->
            <header class="header-nav hidden-sm hidden-xs">
                <div class="container-fluid">
                    <div class="header-inner table-block">
                        <div class="header-comp-logo">
                            <?php include('inc/header/logo.php'); ?>
                        </div>
                        <div class="header-comp-nav text-left">
                            <?php include('inc/header/main-nav.php'); ?>
                        </div>
                        <div class="header-comp-right">
                            <?php include('login1.php'); ?>
                        </div>
                    </div>
                </div>
            </header>
            <!-- mobile header -->
            <?php include('inc/header/header-mobile-full-width.php'); ?>
        </div>
    </div>
    <section id="body-area">

        <div class="dashboard-page-title">
            <h1>Messages</h1>
        </div><!-- .dashboard-page-title -->

        <?php include 'inc/dashboard/dashboard-side-menu-admin.php'; ?>

        <div class="user-dashboard-right dashboard-without-sidebar">
            <div class="dashboard-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="dashboard-area">
                                <div class="block">
                                    <div class="block-title">
                                        <div class="block-left">
                                            <h2 class="title">From</h2>
                                        </div>
                                    </div>

                                    <div class="table-block dashboard-message-table dashboard-table">
                                        <?php
                                        // Step 1: Establish a connection to your database

                                        // Check connection
                                        

                                        // Step 2: Execute a query to retrieve the data
                                        $sql = "SELECT *, u.id AS user_id, m.sender_id, m.reciever_id, 
                                        (select fname from tbl_users where id = m.sender_id) as sender_name, 
                                        (select fname from tbl_users where id = m.reciever_id) as reciever_name
                                        FROM tbl_users u
                                        INNER JOIN tbl_messages m ON u.id = m.sender_id OR u.id = m.reciever_id;";
                                        $result = runRawSql1($sql);

                                        // Step 3: Fetch the data and display it in a table format
                                        if ($result->num_rows > 0) {
                                        ?>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Avatar</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Date</th>
                                                        <th>Message</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Output data of each row
                                                    while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                        <tr>
                                                            <td><img src="<?php echo $row["picture_url"]; ?>" class="img-circle" alt="Image" width="40" height="40"></td>
                                                            <td><strong>
                                                                    <h5 class="text-center ms-5"><?php echo $row["sender_name"]; ?>
                                                                </strong></h5>
                                                            </td>
                                                            <td><strong>
                                                                    <h5 class="text-center ms-5"><?php echo $row["reciever_name"]; ?>
                                                                </strong></h5>
                                                            </td>
                                                            <td><time datetime="<?php echo $row["date"]; ?>"><?php echo date("M d, Y", strtotime($row["date"])); ?></time></td>
                                                            <td><?php echo $row["message"]; ?></td>
                                                            <td>
                                                                <div class="custom-actions">
                                                                    <button class="btn-action" data-toggle="tooltip" data-placement="top" title="View"><i class="homey-icon homey-icon-navigation-right-circle-1-interface-essential"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        <?php
                                        } else {
                                            echo "<p>No data found.</p>";
                                        }

                                        // Close the database connection
                                        // $conn->close();
                                        ?>
                                    </div>
                                </div><!-- .block -->
                                <?php include 'inc/listing/pagination.php'; ?>
                            </div><!-- .dashboard-area -->
                        </div><!-- col-lg-12 col-md-12 col-sm-12 -->
                    </div>
                </div><!-- .container-fluid -->
            </div><!-- .dashboard-content-area -->
        </div><!-- .user-dashboard-right -->
    </section><!-- #body-area -->

    <?php // include 'inc/dashboard/dashboard-footer.php';
    ?>
    <?php include 'inc/scripts.php'; ?>

</body>

</html>