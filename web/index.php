<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8 w/o BOM">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="icon" type="image/x-icon" href="image/map.svg">
    <link rel="stylesheet" href="css/index1.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/card.css?v=<?php echo time(); ?>">
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

    <div id="mainbody">

        <div class="header">
            <div>
                <h1>What are you looking for ?</h1>
                <form method="get" action="search.php">
                    <input type="text" id="email" name="search" type="search" action="search.php"
                        placeholder="Search..." required>
                    <button type="submit" name="submit" value="Submit">Go</button>
                </form>
            </div>
        </div>
        <h1 style="margin: 15px 0 0px 80px !important;">Categories</h1>
        <div class="container">

            <?php

            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];

                echo ' <div class="card">
                <div class="imgBx">
                <img src="imageView.php?image_id=' . $row["category_id"] . '" /><br />
                </div>
                    <div class="contentBx">
                        <h2 style="font-size:24px;">' . $cat . '</h2>
                        <h5 style="color:grey;">' . substr($desc, 0, 100) . '...</h5>
                        <a href="items.php?catid=' . $id . '" id="buy">See Products</a>
                    </div>
                </div>';
            }
            ?>

        </div>
    </div>
    <?php include 'partials/_footer.php'; ?>
    <script src="js/index.js"></script>

</body>

</html>