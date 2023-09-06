<?php
include 'partials/_dbconnect.php';

if (isset($_GET['image_id'])) {
    $sql = "SELECT imageType,imageData FROM `categories` WHERE category_id=" . $_GET['image_id'];
    $result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    header("Content-type: " . $row["imageType"]);
    echo $row["imageData"];
}
mysqli_close($conn);