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
    <link rel="stylesheet" href="css/users.css?v=<?php echo time(); ?>">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>

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
    $sql = "SELECT * FROM `users` `users`.`user_id` =$no";

    if (!$conn) {
        die("Sorry we failed to connect: " . mysqli_connect_error());
    } else {
        if ($no > 0) {
            $sql = "DELETE FROM `users` WHERE `users`.`user_id` = $no";
            $result = mysqli_query($conn, $sql);
        }
    }

    ?>
    <?php

    echo '
    <div class="container" id="c1">
    <h1>Users</h1>

    <div class="shopping-cart" >

            <div class="column-labels">
                <label class="product-image">Profile Picture</label>
                <label class="product-details">Username</label>
                <label class="product-removal">Remove User</label>
                <label class="product-line-price">Signup Date</label>
            </div>';

    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($conn, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['user_id'];
        $name = $row['username'];
        $date1 = $row['datetime'];
        $time = strtotime($date1);
        $date = date("d F, Y \\a\\t g:i A", $time);
        $noResult = false;

        echo '
            <div class="product">
                <div class="product-image">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" />
                </div>
                <div class="product-details">
                    <div class="product-title">' . $name . '</div>
                </div>
               
                <div class="product-removal">
                    <form action="/web/users.php?catid=<?php echo $id; ?>" method="POST">
    <a href="users.php?catid=' . $id . '" class="remove-product" id="buy">Remove User</a></button>
    </form>
    </div>
    <div class="product-line-price">' . $date . '</div>

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