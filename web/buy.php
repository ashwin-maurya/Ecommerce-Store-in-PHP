<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy</title>
    <link rel="stylesheet" href="css/buy.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/other.css?v=<?php echo time(); ?>">

    <?php
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');
    ?>
    <style>
    #alert {
        width: 100%;
        position: relative;
        display: flex;
        justify-content: space-between;
    }

    #alert p {
        position: relative;
        width: auto;
        padding: 0 20px;
        margin-top: 12px !important;
        color: rgb(255, 255, 255);
    }

    #alert button {
        position: relative;
        width: auto;
        padding: 5px 20px;
        background-color: white;
        color: rgb(0, 0, 0);
        border-radius: 0;
        font-size: 30px;
        border: none;
    }

    #alert button:hover {
        background-color: #f0a500;
        color: white;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_menu.php'; ?>
    <?php include 'partials/_other.php'; ?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `items` WHERE product_id=$id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $cat1 = $row['product_name'];
        $desc1 = $row['product_desc'];
        $price1 = $row['product_price'];
        $id = $row['product_id'];
        $p_id = $row['category_id'];
    }
    ?>


    <?php
    // Die if connection was not successful
    if (isset($_POST['submit'])) {
        $user = $_SESSION['user_id'];
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `items` WHERE product_id=$id";
        $result = mysqli_query($conn, $sql);
        while ($row1 = mysqli_fetch_assoc($result)) {
            $id = $row1['product_id'];
            $cat = $row1['product_name'];
            $desc = $row1['product_desc'];
            $price = $row1['product_price'];
            $pID = $row1['category_id'];
        }
        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        } else {


            $sql = "INSERT INTO `cart` (`user_id`,`product_id`,`product_name`,`product_desc`,`product_price`)
    VALUES ('$user','$id','$cat','$desc', '$price');";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: rgb(0, 255, 0); color:white;"><p style="margin-left:40px;">
                <strong>Your Items has been added to the cart! </strong> <a href="cart.php?user=' . $_SESSION['user_id'] . '&t=0&catid=0" id="go">Go to Cart</a>
                </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="hide()">
                <span aria-hidden="true"  >×</span>
                </button>
                </div>';
            } else {
                // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
                echo '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: rgb(255, 161, 161);"><p style="margin-left:40px;">
                <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! </p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"  onclick="hide()">
          <span aria-hidden="true" >×</span>
          </button>
          </div>';
            }
        }
    }

    ?>

    <div class="card">
        <nav>
            <a href="items.php?catid=<?php echo $p_id; ?>" style="font-size: 16px;"><b> Back </b></a>
            <svg class="heart" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" stroke="#727272"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <path
                    d="M340.8,98.4c50.7,0,91.9,41.3,91.9,92.3c0,26.2-10.9,49.8-28.3,66.6L256,407.1L105,254.6c-15.8-16.6-25.6-39.1-25.6-63.9  c0-51,41.1-92.3,91.9-92.3c38.2,0,70.9,23.4,84.8,56.8C269.8,121.9,302.6,98.4,340.8,98.4 M340.8,83C307,83,276,98.8,256,124.8  c-20-26-51-41.8-84.8-41.8C112.1,83,64,131.3,64,190.7c0,27.9,10.6,54.4,29.9,74.6L245.1,418l10.9,11l10.9-11l148.3-149.8  c21-20.3,32.8-47.9,32.8-77.5C448,131.3,399.9,83,340.8,83L340.8,83z"
                    stroke="#727272" />
            </svg>
        </nav>

        <div id="cont">
            <div class="photo">
                <img src="imageViewcart.php?image_id=<?php echo $id; ?> " />
            </div>
            <div class="description">
                <h1><?php echo $cat1; ?> </h1>
                <h3 style="margin:0;"><?php echo (rand(10, 50)); ?>% off</h3>
                <h1>₹<?php echo $price1; ?></h1>
                <p><?php echo $desc1; ?> </p>
                <form action="/web/buy.php?catid=<?php echo $id; ?>" method="POST">
                    <?php
                    if (!$loggedin) {
                        echo '<a href="/web/login.php" >Login to Buy</a>';
                    } elseif ($loggedin) {
                        echo '<button type="submit" name="submit" value="Submit">Add to Cart</button>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>


    <script src=" js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>