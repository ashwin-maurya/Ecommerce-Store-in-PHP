<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/product.css?v=<?php echo time(); ?>">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products</title>

</head>

<body>
    <?php include 'partial/dbconnect.php'; ?>
    <?php include 'partial/nav.php'; ?>
    <?php include 'partial/sidebar.php'; ?>

    <?php
    // Die if connection was not successful

    $sql = "SELECT * FROM `cart`";
    $result = mysqli_query($conn, $sql);

    $no = $_GET['catid'];
    $sql = "SELECT * FROM `items` `items`.`category_id` =$no";

    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    } else {
        if ($no > 0) {
            $sql = "DELETE FROM `items` WHERE `items`.`product_id` = $no";
            $result = mysqli_query($conn, $sql);
        }
    }

    ?>
    <?php

    echo '
    <div class="container" id="c1">
    <h1>Your Products</h1>

    <div class="shopping-cart" >

            <div class="column-labels">
                <label class="product-image">Image</label>
                <label class="product-details">Product</label>
                <label class="product-removal">Cancel Order</label>
                <label class="product-line-price">Product Price</label>
            </div>';

    $sql = "SELECT * FROM `items`";
    $result = mysqli_query($conn, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['product_id'];
        $cat = $row['product_name'];
        $desc = $row['product_desc'];
        $price = $row['product_price'];

        $noResult = false;

        echo '
            <div class="product">
                <div class="product-image">
                    <img src="imageViewcart.php?image_id=' . $id . '" />
                </div>
                <div class="product-details">
                    <div class="product-title">' . $cat . '</div>
                    <p class="product-description">' . substr($desc, 0, 100) . '...</p>
                </div>
               
                <div class="product-removal">
                    <form action="/web/product.php?catid=<?php echo $id; ?>" method="POST">
    <a href="product.php?catid=' . $id . '" class="remove-product" id="buy">Remove</a></button>
    </form>
    </div>
    <div class="product-line-price">' . $price . '.00</div>
    </div>

    ';
    }
    if ($noResult) {
    echo '
    <div>
        <p class="display my-1" style="font-size: 25px;">No Orders.</p>
    </div>
    ';
    }

    echo '


    </div>
    </div>
    ';


    ?>


</body>

</html>