<?php
// Check if the query parameter is set
if (isset($_GET['query'])) {
    // Retrieve the search query
    $search_query = $_GET['query'];
    // Perform the search operation (You would replace this with your actual search logic)
    $sample_data = array("fname", "lname", "nicename", "email", "password");
    $results = array();
    foreach ($sample_data as $data) {
        if (stripos($data, $search_query) !== false) {
            $results[] = $data;
        }
    }

    // Display search results
    if (!empty($results)) {
        foreach ($results as $result) {
            echo "<tr><td>{$result}</td></tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No results found</td></tr>";
    }
} else {
    // If query parameter is not set, return an error or handle the situation accordingly
    echo "<tr><td colspan='7'>Invalid request</td></tr>";
}
?>
