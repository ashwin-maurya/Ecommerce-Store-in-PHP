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
    <title>Review Us</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_menu.php'; ?>
    <?php include 'partials/_other.php'; ?>
    <?php
    if ($loggedin) {
        $user_id = $_SESSION['user_id'];
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $topic = $_POST['topic'];
            $desc = $_POST['brief'];

            // Die if connection was not successful
            if (!$conn) {
                die("Sorry we failed to connect: " . mysqli_connect_error());
            } else {

                $sql = "INSERT INTO `feedback` (`user_id`, `Email`, `product_name`, `Brief`, `DateTime`) VALUES ('$user_id', '$email', '$topic', '$desc', current_timestamp());";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: rgb(0, 255, 0); color:white;"><p style="margin:0 !important;margin-left:40px !important;">
          <strong>Success!</strong> Your entry has been submitted successfully! </p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="hide()" style="width:30px;padding:10px 40px">
            <span aria-hidden="true"  >×</span>
          </button>
        </div>';
                } else {
                    // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
                    echo '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: rgb(255, 161, 161);"><p style="margin:0 !important;margin-left:40px !important;">
          <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! </p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"  onclick="hide() style="width:30px;padding:10px 40px">
            <span aria-hidden="true" >×</span>
          </button>
        </div>';
                }
            }
        }
    }

    if (!$loggedin) {
        echo '
            <div class="container" style="background-color: white;padding: 20px;">
                 <a href="/web/login.php" >
                    <p class="display my-1"  class="log" style="font-size:25px;">
                        Login to add feedback.
                    </p>
                 </a>
            </div>
                          ';
    } elseif ($loggedin) {
        echo '
        
        <div class="container1" style="margin-top: 20px;">
            <form action="/web/contact.php?done" method="post">
            <div class="row">
                <h4 style="margin: 10px 0px;"><b>Your Review</b> </h4>
                
           
            <div class="input-group input-group-icon">
                <input type="email" name="email" placeholder="Email Address" required>
                <div class="input-icon">
                    <img src="image/at-sign.svg" alt="">
                </div>
            </div>
        </div>
        
        <div class="input-group input-group-icon" style="margin-left: 0;">
            <input type="text" name="topic" placeholder="Product Name" required style="margin-left: -15px;">
            <div class="input-icon" style="margin-left: -15px;">
                <img src="image/message-square.svg" alt="">
            </div>
            </div>
            <div class="row">
                <textarea class="u-full-width" name="brief" placeholder="Your Feedback!" required></textarea>
            </div>
            <div class="row" style="margin-top: 15px;">
                <div class="input-group">
                    <button type="submit" name="submit" value="Submit">Submit
                    </button>
                </div>
                <h6 style="margin:0;">Your Reviews help us improve our Service!</h6>
                
            </div>
            
        </form>
    </div>
    ';
    }
    ?>
    <div class="container reviews">
        <h2 style="margin-top: 0;">Reviews</h2>

        <div class="row">
            <?php

            $sql = "SELECT * from feedback INNER join users on feedback.user_id=users.user_id;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['username'];
                $email = $row['Email'];
                $topic = $row['product_name'];
                $brief = $row['Brief'];
                $dt1 = $row['DateTime'];
                $time = strtotime($dt1);
                $dt = date("d F, Y \\a\\t g:i A", $time);
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

                    </div>
                </div>
            </div>

        ';
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

</html>