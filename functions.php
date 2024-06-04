<?php
 function fetchDatatblInvoices($conn)
 {
   $num_per_pages = 8;
   if (isset($_GET['page'])) {
    $page = $_GET['page'];
    
   } else {
     $page = 1;
   }
   $_SESSION['page'] = $page;
 
   // $where_condition = '';
 
   $start_from = ($page - 1) * $num_per_pages;
 
   $sql = "SELECT COUNT(*) AS total FROM tbl_invoices";
   $result = mysqli_query($conn, $sql);
   $total_records = mysqli_fetch_array($result)[0];
   $total_pages = ceil($total_records / $num_per_pages);
   $_SESSION['total_pages'] = $total_pages;
 
 
   $sql = "SELECT tbl_properties.id, order_number, reservation_id, created_at, title, description, status, total
   FROM tbl_invoices 
   INNER JOIN tbl_properties ON tbl_invoices.id = tbl_properties.id 
   LIMIT $num_per_pages offset $start_from";
 
 
    $result = $conn->query($sql);
 
   if (!$result) {
     throw new Exception("Error fetching data: " . $conn->error);
   }
 
   $data = [];
   if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
       $data[] = $row;
     }
   }
 
   $result->free();
 
   return $data;
 }
 
 
 ////fuction for invoice end////
 
 ?>