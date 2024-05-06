<?php
// include('inc/head.php');


// Sanitize and validate property ID if provided for security (optional)
// if (isset($_GET['property-id'])) {
//     $property_id = filter_var($_GET['property-id'], FILTER_SANITIZE_NUMBER_INT);
// } else {
//     $property_id = 1; // Set a default value if not provided
// }

// Securely retrieve logged-in user's nicename using session variable with validation
// session_start(); // Ensure session is started for using session variables

$nicename = isset($_SESSION['nicename']) ? htmlspecialchars($_SESSION['nicename']) : ''; // Escape nicename to prevent XSS

// Optimized SQL query with JOIN on necessary tables
$sql = "SELECT tbl_users.nicename,tbl_images.picture_url
        FROM tbl_users
        INNER JOIN tbl_images ON tbl_images.imageable_id = tbl_users.id
        WHERE tbl_images.imageable_type = 'user'    
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output user image and account dropdown only if logged in user's data is found
    $row = $result->fetch_assoc();

    ?>

    <div class="account-loggedin">
        <?php  if(isset($_SESSION['nicename'])):?>
        <?php  echo isset($_SESSION['nicename'])? $_SESSION['nicename']:''; ?>
        
        <span class="user-image">
            <img src="<?php echo $row["picture_url"]; ?>" alt="profile image" class="img-circle" width="36" height="36">
        </span>
        <div class="account-dropdown">
            <ul>
            <li><a href="dashboard-user.php"><i class="homey-icon homey-icon-house-2"></i> Dashboard</a></li>
            <li><a href="dashboard-profile-host.php"><i class="homey-icon homey-icon-single-neutral-circle"></i> Profile</a></li>
            <li><a href="dashboard-listings.php"><i class="homey-icon homey-icon-layout-agenda-interface-essential"></i> Listings</a></li>
            <li><a href="dashboard-reservations-host.php"><i class="homey-icon homey-icon-calendar-3"></i> Reservations</a></li>
            <li><a href="dashboard-messages.php"><i class="homey-icon homey-icon-messages-bubble-text-1-messages-chat-smileys"></i> Messages</a></li>
            <li><a href="dashboard-favorites.php"><i class="homey-icon love-it"></i> Favorites</a></li>
            <li><a href="dashboard-saved-searches.php"><i class="homey-icon homey-icon-search-1"></i> Saved searches</a></li>
            <li><a href="dashboard-invoices.php"><i class="homey-icon homey-icon-common-file-text-files-folders"></i> Invoices</a></li>
                <form action="login.php" method="POST">
                            <button type="submit" class="btn btn-light mx-5" name="logout_btn">
                                Logout
                            </button>
                </form>
            </ul>
        </div>
        <?php else:?>
            <a href="login.php">Login</a> |
            <a href="register.php">sign Up</a>
            <?php endif;?>
    </div>

    <?php
} 

else {
    // Display appropriate message if no logged-in user or data is found
    echo "You are not logged in or your profile information could not be retrieved.";
}

// Close connection (assuming $conn is your database connection)
// $conn->close();
?>