<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8 w/o BOM">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/index1.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/itemcard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/other.css?v=<?php echo time(); ?>">
    <?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    ?>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_menu.php'; ?>
    <?php include 'partials/_other.php'; ?>

    <?php
    $product_id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$product_id";

    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $cat1 = $row['category_name'];
        $desc1 = $row['category_description'];
    }
    ?>
    <div class="item-desc">
        <h2><b><?php echo $cat1; ?></b></h2>
        <h5><?php echo $desc1; ?> </h5>
    </div>
    <h1 style="margin: 15px 0 0px 80px !important;">Products</h1>
    <div class="container">


        <?php

        $sql = "SELECT * FROM `items`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['product_id'];
            $cat = $row['product_name'];
            $desc = $row['product_desc'];
            $price = $row['product_price'];
            $pID = $row['category_id'];

            if ($pID == $product_id) {
                echo ' <div class="card">
                <div class="imgBx">
                <img src="imageViewcart.php?image_id=' . $row["product_id"] . '" /><br />
        </div>
        <div class="contentBx">
            <h2 style="font-size:18px; font-weight:700;">' . $cat . '</h2>
            <h5>' . substr($desc, 0, 50) . '...</h5>
            <h3>₹' . $price . '</h3>
            <a href="buy.php?catid=' . $id . '" id="buy">Buy Now</a>
        </div>
    </div>';
            }
        }
        ?>

    </div>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="js/index.js"></script>

</body>

</html>