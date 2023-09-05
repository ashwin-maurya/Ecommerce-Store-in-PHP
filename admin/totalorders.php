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
    <link rel="stylesheet" href="css/totalorders.css?v=<?php echo time(); ?>">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Total orders</title>
</head>

<body>
    <?php include 'partial/dbconnect.php'; ?>
    <?php include 'partial/nav.php'; ?>
    <?php include 'partial/sidebar.php'; ?>


    <?php

    echo '
<div class="container" id="c1">
<h1>Orders</h1>

<div class="shopping-cart" >

        <div class="column-labels">
            <label class="product-image">Image</label>
            <label class="product-details">Product</label>
            <label class="product-line-price">Product Price</label>
        </div>';

    $sql = "SELECT * from orders INNER join order_address on orders.order_id=order_address.order_id;";
    $result = mysqli_query($conn, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $user_id = $row['user_id'];
        $cat = $row['product_name'];
        $desc = $row['product_desc'];
        $price = $row['product_price'];
        $img = $row['product_id'];
        $order_id = $row['order_id'];
        $full_name = $row['full_name'];
        $mobile_number = $row['mobile_number'];
        $address = $row['address'];
        $city = $row['city'];
        $state = $row['state'];
        $zip = $row['zip'];
        $datetime1 = $row['datetime'];
        $time = strtotime($datetime1);
        $datetime = date("d F, Y \\a\\t g:i A", $time);

        echo '
                <div class="p">
                <div class="product">
                    <div class="product-image">
                        <img src="imageViewcart.php?image_id=' . $img . '" />
                    </div>
                    <div class="product-details">
                        <div class="product-title"><h3>' . $cat . '</h3></div>
                        <p class="product-description">' . substr($desc, 0, 150) . '...</p>
                    </div>
                    <div class="product-line-price">' . $price . '.00</div>
                </div>';
        echo '
                <div class="order-details">
                    <p>Order Details : </p>
                    <div style="display: flex;flex-direction:row;">
                    <h3>Name : ' . $full_name . '</h3>
                    <h3 style=" text-indent: 2em; ">Mobile Number : ' . $mobile_number . '</h3>
                    </div>
                    <h4>Address : ' . $address . '</h4>
                    <div style="display: flex;flex-direction:row;">
                    <p>City: ' . $city . '</p>
                    <p style=" text-indent: 2em; ">State: ' . $state . '</p>
                    <p style=" text-indent: 2em; ">Pin code: ' . $zip . '</p>
                    <p style=" text-indent: 2em; ">Order date and time : ' . $datetime . '</p>
                    </div>
                </div>
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