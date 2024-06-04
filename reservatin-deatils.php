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
                        <?php include 'inc/header/logo.php'; ?>
                    </div>
                    <div class="header-comp-nav text-left">
                        <?php include 'inc/header/main-nav.php'; ?>
                    </div>
                    <div class="header-comp-right">
                        <?php include 'inc/header/account-user.php'; ?>
                    </div>
                </div>
            </div>
        </header>
        <!-- mobile header -->
        <?php include 'inc/header/header-mobile-full-width.php'; ?>
    </div>
</div>

<section id="body-area">
    <div class="dashboard-page-title">
        <h1>Reservations</h1>
    </div><!-- .dashboard-page-title -->

    <?php include 'inc/dashboard/dashboard-side-menu-user.php'; ?>

    <div class="user-dashboard-right dashboard-with-sidebar">
        <div class="dashboard-content-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="dashboard-area">

                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-hide="alert" aria-label="Close">
                                    <i class="homey-icon homey-icon-close"></i>
                                </button>
                                Your request has been submitted to the host to be confirmed availability.
                            </div>

                            <?php
                            // Include database connection
                            

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                           $reservation_id = $_GET['reservation-id'];
                            $sql = "SELECT 
                            m.id, 
                               status, 
                               title, 
                               subtotal, 
                               adults, 
                               childs, 
                               pets, 
                               check_in, 
                               check_out,
                               date,
                               tbl_cities.name AS city,
                               tbl_provinces.name AS province,
                               tbl_countries.name AS country,
                               (SELECT fname FROM tbl_users WHERE id = m.owner_id) AS sender_name,
                               (SELECT fname FROM tbl_users WHERE id = m.renter_id) AS receiver_name
                           FROM tbl_reservations m
                           INNER JOIN tbl_properties ON tbl_properties.id = m.id
                           INNER JOIN tbl_cities ON tbl_cities.id = tbl_properties.id
                           INNER JOIN tbl_provinces ON tbl_provinces.id = tbl_properties.id
                           INNER JOIN tbl_countries ON tbl_countries.id = tbl_properties.id
                            WHERE m.id='$reservation_id'
                           
                    ";

$result = $conn->query($sql);

if ($result) {
                                $row = $result->fetch_assoc() ?>
                                    <div class="block">
                                        
                                        <div class="block-head">
                                            <div class="block-left">
                                                <h2 class="title">Reservation #<?php echo $row['id']; ?></h2>
                                                <td data-label="Status">
    
                <?php if ($row["status"] == 2) { ?>
                    <span class="label label-warning">BOOKED</span>
                <?php } elseif ($row["status"] == 0) { ?>
                    <span class="label label-danger">DECLINED</span>
                <?php } elseif ($row["status"] == 1) { ?>
                    <span class="label label-info">Available</span>
                <?php } else { ?>
                    <span class="label label-warning">Not Uploaded</span>
                <?php } ?>
    </td>
                                            </div><!-- block-left -->
                                            <div class="block-right">
                                                <div class="custom-actions">
                                                    <button class="btn-action" data-toggle="tooltip" data-placement="top" title="Edit"><i class="homey-icon homey-icon-qpencil-interface-essential"></i></button>
                                                    <button class="btn-action" data-toggle="tooltip" data-placement="top" title="Print"><i class="homey-icon homey-icon-print-text"></i></button>
                                                    <button class="btn-action" data-toggle="tooltip" data-placement="top" title="Send Message"><i class="homey-icon homey-icon-unread-emails"></i></button>
                                                    <button class="btn-action" data-toggle="tooltip" data-placement="top" title="Back"><i class="homey-icon homey-icon-move-back-interface-essential"></i></button>
                                                </div><!-- custom-actions -->
                                            </div><!-- block-right -->
                                        </div><!-- block-head -->

                                        <div class="collapse" id="decline-reservation">
                                            <div class="reason-msg-block">
                                                <h3 class="title">Decline Reason</h3>
                                                <form>
                                                    <div class="text-area-block">
                                                        <textarea name="msg-text" class="form-control" placeholder="" rows="5"></textarea>
                                                    </div>
                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-grey-light btn-xs-full-width">Submit</button>
                                                    </div>
                                                </form>
                                            </div><!-- reason-msg-block -->
                                        </div><!-- collapse -->

                                        <div class="block-section">
                                            <div class="block-body">
                                                <div class="block-left">
                                                    <ul class="detail-list">
                                                        <li><strong>Date:</strong></li>
                                                        <li><?php echo $row['date']; ?></li>
                                                    </ul>
                                                </div><!-- block-left -->
                                                <div class="block-right">
                                                    <img src="img/guest-avatar-100x100.png" alt="Thumb" width="64" height="64" class="reserve-detail-avatar img-circle">
                                                    <ul class="detail-list">
                                                        <li><strong>From:</strong> <?php //echo $row['title']; ?></li>
                                                        <li><?php echo $row['sender_name']; ?></li>
                                                    </ul>
                                                </div><!-- block-right -->
                                            </div><!-- block-body -->
                                        </div><!-- block-section -->

                                        <div class="block-section">
                                            <div class="block-body">
                                                <div class="block-left">
                                                    <h2 class="title">Host</h2>
                                                </div><!-- block-left -->
                                                <div class="block-right">
                                                    <img src="img/host-avatar-100x100.png" alt="Thumb" width="64" height="64" class="reserve-detail-avatar img-circle">
                                                    <ul class="detail-list">
                                                        <li><strong>Name:</strong> <a href="#"><?php echo $row['receiver_name']; ?></a></li>
                                                        <li><strong>Email:</strong> <a href="#">email@email.com</a></li>
                                                        <li><strong>Phone:</strong> <a href="#">+1 987 7654 321</a></li>
                                                    </ul>
                                                </div><!-- block-right -->
                                            </div><!-- block-body -->
                                        </div><!-- block-section -->

                                        <div class="block-section">
                                            <div class="block-body">
                                                <div class="block-left">
                                                    <h2 class="title">Details</h2>
                                                </div><!-- block-left -->
                                                <div class="block-right">
                                                    <ul class="detail-list detail-list-2-cols">
                                                        <li>Check In: <strong><?php echo $row['check_in']; ?></strong></li>
                                                        <li>Check Out: <strong><?php echo $row['check_out']; ?></strong></li>
                                                        <li>Pets: <strong><?php echo $row['pets']; ?></strong></li>
                                                        <li>Adults: <strong><?php echo $row['adults']; ?></strong></li>
                                                        <li>Children: <strong><?php echo $row['childs']; ?></strong></li>
                                                    </ul>
                                                </div><!-- block-right -->
                                            </div><!-- block-body -->
                                        </div><!-- block-section -->
                                    </div><!-- .block -->
                                <?php 
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                            ?>

                            <div class="block-section">
                                <div class="block-body">
                                    <div class="block-left">
                                        <h2 class="title">Notes</h2>
                                    </div><!-- block-left -->
                                    <div class="block-right">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vehicula eget turpis laoreet pulvinar. Vestibulum condimentum massa ac hendrerit auctor. Quisque tincidunt pulvinar iaculis.</p>
                                        <a class="btn btn-primary btn-slim" href="#">Reply</a>
                                    </div><!-- block-right -->
                                </div><!-- block-body -->
                            </div><!-- block-section -->

                            <div class="block-section">
                                <div class="block-body">
                                    <div class="block-left">
                                        <h2 class="title">Payment</h2>
                                    </div><!-- block-left -->
                                    <div class="block-right">
                                        <?php include 'inc/booking/payment-list.php'; ?>
                                    </div><!-- block-right -->
                                </div><!-- block-body -->
                            </div><!-- block-section -->

                        </div><!-- .dashboard-area -->
                    </div><!-- col-lg-12 col-md-12 col-sm-12 -->
                </div>
            </div><!-- .container-fluid -->
        </div><!-- .dashboard-content-area -->
        <aside class="dashboard-sidebar">
            <?php include 'inc/dashboard/dashboard-payment-details-block.php'; ?>
            <span class="btn btn-success-outlined btn-full-width"><i class="homey-icon homey-icon-check-circle-1"></i> Submitted</span>
            <button class="btn btn-grey-light btn-full-width" data-toggle="collapse" data-target="#decline-reservation" aria-expanded="false" aria-controls="collapseExample">Decline</button>
        </aside><!-- .dashboard-sidebar -->
    </div><!-- .user-dashboard-right -->
</section><!-- #
