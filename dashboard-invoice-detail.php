<?php
include('inc/head.php');

$order_number = $_GET['order-number'];

$sql = "SELECT title, description, order_number, created_at, fname, lname, email, total, additional_info
FROM tbl_invoices
INNER JOIN tbl_properties ON tbl_invoices.id = tbl_properties.id
INNER JOIN tbl_users ON tbl_users.id = tbl_properties.id WHERE tbl_invoices.order_number = '$order_number' " ; 




$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each inovoice
    $row = $result->fetch_assoc()

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
                            <?php include ('inc/header/account-user.php'); ?>
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
            <h1>Payment Confirmation</h1> 
        </div><!-- .dashboard-page-title -->

        <?php include 'inc/dashboard/dashboard-side-menu-user.php';?>

        <div class="user-dashboard-right dashboard-with-sidebar">
            <div class="dashboard-content-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="dashboard-area">
                                <div class="invoice-detail block">
                                    <div class="invoice-header clearfix">
                                        <div class="block-left">
                                            <div class="invoice-logo">
                                                <?php include ('inc/header/logo.php'); ?>
                                            </div>
                                            <ul class="list-unstyled">
                                                <li><strong><?php echo $row["title"]; ?></strong></li>
                                                <li><address><?php echo $row["description"]; ?></address></li>
                                            </ul>
                                        </div>
                                        <div class="block-right">
                                            <ul class="list-unstyled">
                                                <li><strong>Invoice:</strong> <?php echo $row["order_number"]; ?></li>
                                                <li><strong>Date: </strong><?php echo $row["created_at"]; ?> </li>
                                            </ul>
                                        </div>
                                    </div><!-- invoice-header -->

                                    <div class="invoice-body clearfix">
                                        <ul class="list-unstyled">
                                            <li><strong>To:</strong></li>
                                            <li><?php echo $row["fname"]; ?> <?php echo $row["lname"]; ?></li> 
                                            <li>Email: <?php echo $row["email"]; ?></li>
                                        </ul>  
                                        <h2 class="title">Details</h2>    
                                        <?php include ('inc/booking/payment-list.php'); ?> 
                                    </div><!-- invoice-body -->

                                    <div class="invoice-footer clearfix">
                                        <dl>
                                            <dt>Additional Information:</dt>
                                            <dd><?php echo $row["additional_info"]; ?></dd>
                                        </dl>
                                    </div><!-- invoice-footer -->
                                </div>

                            </div><!-- .dashboard-area -->
                        </div><!-- col-lg-12 col-md-12 col-sm-12 -->
                    </div>
                </div><!-- .container-fluid -->
            </div><!-- .dashboard-content-area -->   
            <aside class="dashboard-sidebar">
                <button class="btn btn-grey btn-full-width">Print</span>
            </aside><!-- .dashboard-sidebar -->             
        </div><!-- .user-dashboard-right -->

    </section><!-- #body-area -->

    <?php // include 'inc/dashboard/dashboard-footer.php';?>
    <?php include 'inc/scripts.php';?>

</body>
</html>

<?php  
} else {
    echo "0 results";
}
?>
