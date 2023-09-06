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
    <title>Your cart</title>
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/other.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/checkout.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/cart.css?v=<?php echo time(); ?>">
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
    $user = $_SESSION['user_id'];



    if (isset($_POST['submit'])) {
        $sql = "SELECT * FROM `cart`";
        $result1 = mysqli_query($conn, $sql);
        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        } else {
            while ($row = mysqli_fetch_assoc($result1)) {
                $user_id = $row['user_id'];
                $id = $row['product_id'];
                $cat = $row['product_name'];
                $desc = $row['product_desc'];
                $price = $row['product_price'];
                $img = $row['product_id'];

                if ($_SESSION['user_id'] == $user_id) {
                    $sql = "INSERT INTO `orders` (`user_id`,`product_id`,`product_name`,`product_desc`,`product_price`)
                VALUES ('$user','$id','$cat','$desc', '$price');";
                    $result = mysqli_query($conn, $sql);
                }
                $sql = "SELECT * FROM `orders`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_id = $row['user_id'];
                    $order_id = $row['order_id'];
                }
                if (isset($_POST['submit'])) {

                    $full_name = $_POST['name'];
                    $mobile_number = $_POST['number'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $zip = $_POST['zip'];

                    if (!$conn) {
                        die("Sorry we failed to connect: " . mysqli_connect_error());
                    } else {

                        if ($_SESSION['user_id'] == $user_id) {
                            $sql = "INSERT INTO `order_address` (`order_id`,`full_name`, `mobile_number`, `address`, `city`, `state`, `zip`,`datetime`) VALUES ('$order_id','$full_name','$mobile_number','$address','$city','$state','$zip',current_timestamp());";

                            $result = mysqli_query($conn, $sql);
                        }
                    }
                }
            }



            if ($result) {
                echo '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: rgb(0, 255, 0); color:white;"><p style="margin-left:40px;">
              <strong>Success!</strong> Order Placed Successfully!</p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="hide()">
                <span aria-hidden="true"  >×</span>
              </button>
            </div>';
            } else {
                // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
                echo '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: rgb(255, 161, 161);"><p style="margin-left:40px;">
              <strong>Error!</strong> We are facing some technical issue and your order was not placed</p>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"  onclick="hide()">
                <span aria-hidden="true" >×</span>
              </button>
            </div>';
            }
        }
    }

    if (isset($_POST['submit'])) {
        $sql = "SELECT * FROM `cart`";
        $result = mysqli_query($conn, $sql);

        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        } else {
            $sql = "TRUNCATE TABLE `cart`; ";
        }
        $result = mysqli_query($conn, $sql);
    }
    ?>
    <?php
    // Die if connection was not successful

    $sql = "SELECT * FROM `cart`";
    $result = mysqli_query($conn, $sql);

    $cart_id = $_GET['catid'];
    $sql = "SELECT * FROM `cart` `cart`.`cart_id` =$cart_id";


    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    } else {
        if ($cart_id > 0) {
            $sql = "DELETE FROM `cart` WHERE `cart`.`cart_id` = $cart_id";
            $result = mysqli_query($conn, $sql);
        }
    }

    ?>
    <?php

    echo '
    <div class="container" id="c1">
    <h1>Shopping Cart</h1>

    <div class="shopping-cart" >

            <div class="column-labels">
                <label class="product-image">Image</label>
                <label class="product-details">Product</label>
                <label class="product-price">Price</label>
                <label class="product-removal">Remove</label>
                <label class="product-line-price">Total</label>
            </div>';

    $noResult = true;
    $sql = "SELECT * FROM `cart`";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $cat = $row['product_name'];
        $desc = $row['product_desc'];
        $price = $row['product_price'];
        $img = $row['product_id'];
        $cart_id = $row['cart_id'];

        if ($_SESSION['user_id']  == $user_id) {
            $noResult = false;
            echo '
            <div class="product">
                <div class="product-image">
                    <img src="imageViewcart.php?image_id=' . $img . '" />
                </div>
                <div class="product-details">
                    <div class="product-title">' . $cat . '</div>
                    <p class="product-description">' . substr($desc, 0, 150) . '...</p>
                </div>
                <div class="product-price">' . $price . '.00</div>

                <div class="product-removal">
                    <form action="/web/cart.php?user=' . $_SESSION['user_id']  . '&t=0&catid=0" method="POST">
    <a href="cart.php?user=' . $_SESSION['user_id'] . '&t=0&catid=' . $cart_id . '" class="remove-product" id="buy">Remove</a></button>
    </form>
    </div>
    <div class="product-line-price">' . $price . '.00</div>
    </div>
    ';
        }
    }

    if ($noResult) {
        echo '
    <div>
        <p class="display my-1" style="font-size: 25px;">No items in the cart.</p>
    </div>
    ';
    }
    echo '
    </div>
    </div>
    </div>
    ';
    $noResult1 = true;
    $sql = "SELECT * FROM `user_details` WHERE user_id=$user";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $noResult1 = false;
        $user_id = $row['user_id'];
        $full_name = $row['full_name'];
        $mobile_number = $row['mobile_number'];
        $email = $row['email'];
        $address = $row['address'];
        $city = $row['city'];
        $state = $row['state'];
        $zip = $row['zip'];
        $datetime1 = $row['datetime'];
        $time = strtotime($datetime1);
        $datetime = date("d F, Y g:i A", $time);
    }
    echo '
    <div class="container1" id="c2">
    <span id="back" onclick="back()">Back</span>
    <div class="row">
        <div class="col-75">
            <div class="container" style="margin: 10px 90px 0 90px;">
                <div class="row">
                    <div class="col-50">
                        <h3>Billing Address</h3>
                        <div class="row">
                        <div class="col-50">
                        <form action="/web/cart.php?user=' . $_SESSION['user_id']  . '&t=0&catid=0" method="POST">
                        <label for="fname"> Full Name</label>
                        <input type="text" id="fname" name="name" placeholder="Eg. Rohan Das" value="';
    if (!$noResult1) {
        echo $full_name;
    }
    echo '" required>
                        </div>
                        <div class="col-50">
                        <label for="fname"> Mobile Number</label>
                        <input type="tele" id="tele" name="number" placeholder="Eg. 99XXXXXXXX" value="';
    if (!$noResult1) {
        echo $mobile_number;
    }
    echo '" required>
                        </div>
                        </div>

                        <label for="adr"> Address</label>
                        <input type="text" id="adr" name="address" placeholder="Eg. 542 W. 15th Street" value="';
    if (!$noResult1) {
        echo $address;
    }
    echo '" required>
                        <label for="city"> City</label>
                        <input type="text" id="city" name="city" value="';
    if (!$noResult1) {
        echo $city;
    }
    echo '" placeholder="Eg. New York" required> 

                        <div class="row">
                            <div class="col-50">
                                <label for="state">State</label>
                                <select id="state" name="state" required>
                                    <option selected value="';
    if (!$noResult1) {
        echo $state;
    }
    echo '">';
    if (!$noResult1) {
        echo $state;
    }
    echo '</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                        <option value="Daman and Diu">Daman and Diu</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Puducherry">Puducherry</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                </select>
                            </div>
                            <div class="col-50">
                                <label for="zip">Zip</label>
                                <input type="text" id="zip" name="zip" placeholder="Eg. 412105" value="';
    if (!$noResult1) {
        echo $zip;
    }
    echo '" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-50">
                        <h3>Payment</h3>
                        <label for="fname"></label>
                        <h3>Card details</h3>
                        <label for="cname">Name on Card</label>
                        <input type="text" id="cname" name="cardname" placeholder="Rohan Das">
                        <label for="ccnum">Credit card number</label>
                        <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                        <div class="row">
                        <div class="col-50">
                        <label for="expmonth">Exp</label>
                        <input type="date" id="expmonth" name="expmonth" placeholder="September">
                        </div>
                            <div class="col-50">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="352">
                            </div>
                        </div>
                    </div>

                </div>
                <label>
                                        </label>
                    <button type="submit" name="submit" class="btn" value="Submit">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
    ';

    if (!$noResult) {
        echo '
    <div class="container3" id="c4">

        <div class="totals">
        <div class="totals-item">
        <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal"></div>
                </div>
                <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping"></div>
                </div>
                <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total"></div>
            </div>

            <span class="checkout" onclick="buy()" id="c3">Checkout</span>
        </div>
        </div>


    ';
    }

    ?>



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