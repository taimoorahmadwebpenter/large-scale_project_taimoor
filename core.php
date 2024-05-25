<?php

function getPaginationLinks($page, $total_pages) {
    $pagination_links = "<div class='pagination'>";
    if ($page > 1) {
        $pagination_links .= "<a href='users.php?page=" . ($page - 1) . "'>&laquo; Previous</a>";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination_links .= "<a href='users.php?page=" . $i . "'>" . $i . "</a>";
    }
    if ($page < $total_pages) {
        $pagination_links .= "<a href='users.php?page=" . ($page + 1) . "'>Next &raquo;</a>";
    }
    $pagination_links .= "</div>";
    
    return $pagination_links;
}

function getPaginatedData($conn, $page, $num_per_page, $filtervalue) {
    $start_from = ($page - 1) * $num_per_page;
    $filterdata = "SELECT picture_url, fname, lname, email, tbl_roles.name 
                   FROM tbl_users 
                   INNER JOIN tbl_roles ON tbl_users.id = tbl_roles.id
                   INNER JOIN tbl_images ON tbl_images.imageable_id = tbl_users.id 
                   WHERE tbl_images.imageable_type = 'user' 
                   AND CONCAT(fname, lname, email, name) LIKE '%$filtervalue%' 
                   LIMIT $start_from, $num_per_page";
    $filterdata_run = runRawSql1($filterdata);
    return $filterdata_run;
}

function getTotalPages($conn, $num_per_page, $filtervalue) {
    $total_records_query = "SELECT COUNT(*) AS total 
                            FROM tbl_users 
                            INNER JOIN tbl_roles ON tbl_users.id = tbl_roles.id
                            INNER JOIN tbl_images ON tbl_images.imageable_id = tbl_users.id 
                            WHERE tbl_images.imageable_type = 'user' 
                            AND CONCAT(fname, lname, email, name) LIKE '%$filtervalue%'";
    $total_records_result = runRawSql1($total_records_query);
    $total_records_row = mysqli_fetch_assoc($total_records_result);
    $total_records = $total_records_row['total'];
    $total_pages = ceil($total_records / $num_per_page);
    return $total_pages;
}

?>
