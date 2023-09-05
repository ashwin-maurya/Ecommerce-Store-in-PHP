<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your orders</title>
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/other.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/order.css?v=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->

    <?php
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');
    ?>
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_menu.php'; ?>
    <?php include 'partials/_other.php'; ?>

    <?php
    $order_id = $_GET['catid'];
    $sql = "SELECT * FROM `order_address` `order_address`.`order_id` =$order_id";

    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    } else {
        if ($order_id > 0) {
            $sql = "DELETE FROM `order_address` WHERE `order_address`.`order_id` = $order_id";
            $result = mysqli_query($conn, $sql);
        }
    }

    ?>
    <?php
    // Die if connection was not successful

    $order_id = $_GET['catid'];
    $sql = "SELECT * FROM `orders` `orders`.`order_id` =$order_id";

    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    } else {
        if ($order_id > 0) {
            $sql = "DELETE FROM `orders` WHERE `orders`.`order_id` = $order_id";
            $result = mysqli_query($conn, $sql);
        }
    }
    ?>

    <?php

    echo '
    <div class="container">
    
    <div class="shopping-cart" >
    <h1 style="margin:0px 0 20px 0;">Your Orders</h1>

            <div class="column-labels">
                <label class="product-image">Image</label>
                <label class="product-details">Product</label>
                <label class="product-removal">Cancel Order</label>
                <label class="product-line-price">Product Price</label>
            </div>';

    $sql = "SELECT * from orders INNER join order_address on orders.order_id=order_address.order_id;";
    $result = mysqli_query($conn, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
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

        if ($_SESSION['user_id'] == $user_id) {
            $noResult = false;




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
        
                <div class="product-removal">
                    <form action="/web/order.php" method="POST">
                        <a href="order.php?catid=' . $order_id . '" class="remove-product" id="buy">Cancel</a></button>
                    </form>
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
    }

    if ($noResult) {
        echo '
    <div>
        <h1 class="display my-1" style="font-size: 25px;">No Orders.</h1>
    </div>
    ';
    }

    if (!$noResult) {
        echo '
    <div style="float:right;">
        <span>Total: </span>
        <span class="totals-value " id="cart-total"> </span>
    </div>';
    }
    echo '
    </div>
    </div>
    ';


    ?>
    <!-- <div style="display: flex;flex-direction:row;"></div> -->


    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script> -->

    <script src="js/index.js"></script>
    <script src="js/cart.js"></script>
</body>

</html>
</script>
</body>

</html>