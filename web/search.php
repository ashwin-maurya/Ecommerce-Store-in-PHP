<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8 w/o BOM">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/index1.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/itemcard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/other.css?v=<?php echo time(); ?>">

</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_menu.php'; ?>
    <?php include 'partials/_other.php'; ?>

    <?php
    $query = $_GET["search"];

    echo '
    <div id="mainbody">

        <div class="header">
            <div>
                <h1>What are you looking for ?</h1>
                <form method="get" action="search.php">
                    <input type="text" id="email" name="search" type="search" action="search.php" value="' . $query . '"
                        placeholder="Search..." required>
                    <button type="submit" name="submit" value="Submit">Go</button>
                </form>
            </div>
        </div>
       
        <h1 style="margin: 15px 0 0px 80px !important;">Search Results</h1>
        <div class="container">';
    ?>
    <?php
    $noresults = true;
    $query = $_GET["search"];
    $sql = "SELECT * FROM `items`";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['product_id'];
        $cat = $row['product_name'];
        $desc = $row['product_desc'];
        $price = $row['product_price'];
        $pID = $row['category_id'];

        // Display the search result

        if (strtolower($cat) == strtolower($query)) {
            $noresults = false;
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
    if ($noresults) {

        echo '
                    <div class="container" style="background-color: white; padding:20px">
                        <div><h2>No Results Found</h2></div>
                        <div> <h3>Suggestions: </h3><ul>
                                <li><h4>Make sure that all words are spelled correctly.</h4></li>
                                <li><h4>Try more general product names.</h4></li></ul>
                        </div>
                    </div>';
    }
    ?>

    <?php include 'partials/_footer.php'; ?>
    <script src="js/index.js"></script>
</body>

</html>