<!DOCTYPE html>
<html lang="en">

<head>
   <?php include 'inc/head.php'; ?>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                     <?php include('inc/header/account-host1.php'); ?>
                  </div>
                  <div class="header-comp-right">
                     <?php include('inc/header/login-register-v1.php'); ?>
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
      </div>
      <!-- .dashboard-page-title -->
      <?php include 'inc/dashboard/dashboard-side-menu-host.php'; ?>
      <div class="user-dashboard-right dashboard-without-sidebar">
         <div class="dashboard-content-area">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <?php
                     $sql_img_wala = "SELECT m.sender_id, u.fname AS sender_name, p.title AS property_title, i.picture_url as image_path
                        FROM tbl_messages m
                        INNER JOIN tbl_users u ON m.sender_id = u.id
                        LEFT JOIN tbl_properties p ON u.id = p.id -- Adjusted to match the correct foreign key relationship
                        LEFT JOIN tbl_images i ON i.id = m.reciever_id -- Adjusted to match the correct foreign key relationship
                        ORDER BY m.date DESC, m.time DESC;";
                     // Assuming $messageSentStatus is a variable that holds the status of the message (true/false)
                     $messageSentStatus = true; // This should be dynamically determined based on your application logic

                     // Conditionally display messages based on $messageSentStatus
                     if ($messageSentStatus) {
                        echo '<div class="alert alert-success alert-dismissible" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="homey-icon homey-icon-close"></i></button>
                           The message has been sent.
                           </div>';
                     } else {
                        echo '<div class="alert alert-danger alert-dismissible" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="homey-icon homey-icon-close"></i></button>
                           Something went wrong. Please try again.
                           </div>';
                     }
                     ?>
                     SUGGESTIONS
                     <div class="messages-area-user-info">
                        <div class="messages-area-user-status">
                           <div class="media">
                              <div class="media-left">
                                 <?php
                                 // Assuming $conn is your database connection
                                 $sql = "SELECT m.sender_id, u.fname AS sender_name, p.title AS property_title
FROM tbl_messages m
INNER JOIN tbl_users u ON m.sender_id = u.id
LEFT JOIN tbl_properties p ON u.id = p.id -- Assuming 'user_id' is the foreign key in tbl_properties referencing tbl_users
ORDER BY m.date DESC, m.time DESC;";

                                 $result = runRawSql1($sql_img_wala);

                                 // Fetch all rows at once
                                 $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                 $row = $rows[0];
                                 // print_r($row);
                                 // exit;
                                 // Start the HTML structure
                                 echo '<div class="media">';
                                 echo '<div class="media-left">';
                                 echo '<a href="#" class="media-object">';


                                 if (isset($row["image_path"])) {
                                    echo '<img src="' . $row["image_path"] . '" class="img-circle" alt="np-img">';
                                 }

                                 echo '</a>';
                                 echo '</div>';

                                 // Use foreach to iterate through the fetched rows
                                 foreach ($rows as $row) {
                                    // Display sender and title dynamically
                                    echo '<div class="media-body media-middle">';
                                    echo '<div class="msg-user-info">';
                                    echo '<div class="msg-user-left">';
                                    echo '<div><strong>' . htmlspecialchars($row['sender_name']) . '</strong> on <strong>' . htmlspecialchars($row['property_title']) . '</strong></div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                 }

                                 // Close the media div
                                 echo '</div>';
                                 ?>
                                 <?php
                                 // Assuming $userStatus is a variable that holds the user's online status (1 for online, 0 for offline)
                                 $userStatus = 1; // This should be dynamically determined based on your application logic

                                 // Conditionally display online or offline status based on $userStatus
                                 if ($userStatus == 1) {
                                    echo '<div class="user-status">
                                             <i class="homey-icon homey-icon-circle text-success" aria-hidden="true"></i> Status: <strong>Online</strong>
                                             </div>';
                                 } else {
                                    echo '<div class="user-status">
                                             <i class="homey-icon homey-icon-circle text-danger" aria-hidden="true"></i> Status: <strong>Offline</strong>
                                             </div>';
                                 }
                                 ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php
               // Fetch messages from the database
               $sql = "SELECT p.id AS sender_id, u.fname AS sender_name, title, m.message, m.date, m.time 
                           FROM tbl_messages m
                           INNER JOIN tbl_users u ON m.sender_id = u.id
                           INNER JOIN tbl_properties p ON u.id = p.id
                           ORDER BY m.date DESC, m.time DESC;";
               $result = runRawSql1($sql);
               // Start the HTML structure
               echo '<div class="messages-area">';

               // Loop through the messages
               while ($row = $result->fetch_assoc()) {
                  // Determine if the message is from the agent or a reply
                  $isAgentMessage = $row['sender_name'] === 'Agent'; // Assuming 'Agent' is a special value indicating agent messages

                  echo '<div class="' . ($isAgentMessage ? 'msg-to-agent-block' : 'msgs-reply-list') . '">';

                  // Generate the media object for the sender
                  echo '<div class="media">';
                  echo '<div class="media-left">';
                  echo '<a href="#" class="media-object">';
                  echo '<img src="img/guest-avatar-70x70.png" class="img-circle" width="70" height="70" alt="user Image">';
                  echo '</a>';
                  echo '</div>';

                  // Generate the message body
                  echo '<div class="media-body media-middle">';
                  echo '<div class="msg-user-info">';
                  echo '<div class="msg-user-left">';
                  echo '<div><strong>' . htmlspecialchars($row['sender_name']) . '</strong> on <strong>' . htmlspecialchars($row['title']) . '</strong></div>';
                  echo '<div class="message-date">';
                  echo '<time datetime="' . htmlspecialchars($row['date']) . 'T' . htmlspecialchars($row['time']) . '"><i class="homey-icon homey-icon-calendar-3"></i> ' . htmlspecialchars($row['date']) . ' <i class="homey-icon homey-icon-time-clock-circle"></i> ' . htmlspecialchars($row['time']) . '</time>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '<p>' . htmlspecialchars($row['message']) . '</p>';
                  echo '</div>';
                  echo '</div>';

                  echo '</div>'; // Close the media div
               }

               // Close the messages area div
               echo '</div>';
               ?>
               <div class="media msg-send-block">
                  <div class="media-left">
                     <?php



                     if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                     }

                     // SQL query to join tbl_images and tbl_users
                     $sql = "SELECT tbl_images.picture_url, tbl_users.fname FROM tbl_images INNER JOIN tbl_users ON tbl_images.imageable_id = tbl_users.id  WHERE tbl_images.imageable_type = 'user' 
LIMIT 1"; // Modify the WHERE clause as needed

                     $result = runRawSql1($sql);

                     if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                           echo '<div class="media-object">';
                           echo '<img src="' . $row["picture_url"] . '" class="img-circle" alt="' . $row["fname"] . '">';
                           echo '</div>';
                        }
                     } else {
                        echo "0 results";
                     }

                     ?>
                  </div>
                  <div class="media-body">
                     <h4 class="media-heading">Reply</h4>
                     <form action="send_message.php" method="post">
                        <div class="msg-type-block">
                           <div class="arrow"></div>
                           <textarea id="messageInput" name="message" class="form-control" placeholder="Type your message here..." rows="5"></textarea>
                           <!-- Other elements remain unchanged -->
                        </div>
                        <div class="form-msg-btns">
                           <button type="submit" class="btn btn-success">Send</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- .dashboard-area -->
      </div>
      <!-- col-lg-12 col-md-12 col-sm-12 -->
      </div>
      </div><!-- .container-fluid -->
      </div><!-- .dashboard-content-area -->
      </div><!-- .user-dashboard-right -->

   </section>
   <!-- #body-area -->
   <?php // include 'inc/dashboard/dashboard-footer.php';
   ?>
   <?php include 'inc/scripts.php'; ?>
</body>

</html>