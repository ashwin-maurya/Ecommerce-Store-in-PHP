<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:/web/admin/logout.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/sidebar.css?v=<?php echo time(); ?>">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

</head>

<body>
    <?php include 'partial/dbconnect.php'; ?>
    <?php include 'partial/nav.php'; ?>
    <?php include 'partial/sidebar.php'; ?>




    <section class="home-section">

        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Orders</div>
                        <div class="number">
                            <?php
                            $sql = "SELECT * from orders";

                            if ($result = mysqli_query($conn, $sql)) {
                                $rowcount = mysqli_num_rows($result);
                                echo $rowcount;
                            }
                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-cart-alt cart'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Products</div>
                        <div class="number">
                            <?php
                            $sql = "SELECT * from items";

                            if ($result = mysqli_query($conn, $sql)) {
                                $rowcount = mysqli_num_rows($result);
                                echo $rowcount;
                            }
                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-shopping-bag cart'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Users</div>
                        <div class="number">
                            <?php
                            $sql = "SELECT * from users";

                            if ($result = mysqli_query($conn, $sql)) {
                                $rowcount = mysqli_num_rows($result);
                                echo $rowcount;
                            }
                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-user cart'></i>
                </div>
            </div>
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Feedback</div>
                        <div class="number">
                            <?php
                            $sql = "SELECT * from feedback";

                            if ($result = mysqli_query($conn, $sql)) {
                                $rowcount = mysqli_num_rows($result);
                                echo $rowcount;
                            }
                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bxs-message cart two'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Income</div>
                        <div class="number">Rs.
                            <?php
                            $sql_qry = "SELECT SUM(product_price) AS count 
                            FROM orders ";

                            $duration = $conn->query($sql_qry);
                            $record = $duration->fetch_array();
                            $total = $record['count'];

                            echo $total;

                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up from yesterday</span>
                        </div>
                    </div>
                    <i class='bx bx-wallet cart three'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Profit</div>
                        <div class="number">Rs.
                            <?php
                            $sql_qry = "SELECT SUM(product_price) AS count 
                            FROM orders ";

                            $duration = $conn->query($sql_qry);
                            $record = $duration->fetch_array();
                            $total = $record['count'];

                            echo round($total / 15);

                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-down-arrow-alt down'></i>
                            <span class="text">Down From Today</span>
                        </div>
                    </div>
                    <i class='bx bxs-meteor cart four'></i>
                </div>
            </div>
    </section>


</body>

</html>