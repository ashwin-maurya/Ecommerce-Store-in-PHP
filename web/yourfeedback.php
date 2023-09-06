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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/contact2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/other.css?v=<?php echo time(); ?>">
    <title>Your Feedbacks</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_menu.php'; ?>
    <?php include 'partials/_other.php'; ?>

    <div class="container reviews">
        <h2 style="margin-top: 0;">Your Feedbacks</h2>

        <div class="row">
            <?php

            $sql = "SELECT * FROM `feedback`";
            $result = mysqli_query($conn, $sql);

            $feedback_id = $_GET['catid'];
            $sql = "SELECT * FROM `cart` `cart`.`feedback_id` =$feedback_id";


            if (!$conn) {
                die("Sorry we failed to connect: " . mysqli_connect_error());
            } else {
                if ($feedback_id > 0) {
                    $sql = "DELETE FROM `feedback` WHERE `feedback`.`feedback_id` = $feedback_id";
                    $result = mysqli_query($conn, $sql);
                }
            }
            ?>


            <?php
            $sql = "SELECT * from feedback INNER join users on feedback.user_id=users.user_id;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['username'];
                $email = $row['Email'];
                $topic = $row['product_name'];
                $brief = $row['Brief'];
                $user_id = $row['user_id'];
                $feedback_id = $row['feedback_id'];
                $dt1 = $row['DateTime'];
                $time = strtotime($dt1);
                $dt = date("d F, Y \\a\\t g:i A", $time);

                if ($_SESSION['user_id']  == $user_id) {
                    echo ' 
        <div class="col-md-6">
                <div class="media g-mb-30 media-comment">
                    <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
                        src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                        <div class="g-mb-15">
                            <h5 class="h5 g-color-gray-dark-v1 mb-0">' . $name . '</h5>
                            <span class="g-color-gray-dark-v4 g-font-size-12">' . $dt . '</span>
                        </div>
                        <h4><b> ' . $topic . ' </b></h4>
                        <p><i>"' . $brief . '"</i></p>
                        <a href="yourfeedback.php?user=' . $_SESSION['user_id'] . '&catid=' . $feedback_id . '">
                        Remove this Feedback
                        </a>
                        </div>
                    </div>
            </div>

        ';
                }
            }
            ?>



        </div>
    </div>

    <?php include 'partials/_footer.php'; ?>
    <script src="js/index.js"></script>
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

</html> integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
</body>

</html>