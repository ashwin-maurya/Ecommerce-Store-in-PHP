<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/messages.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/nav.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Messages</title>

</head>

<body>
    <?php include 'partial/dbconnect.php'; ?>
    <?php include 'partial/nav.php'; ?>
    <?php include 'partial/sidebar.php'; ?>

    <div class="container">
        <h2 style="margin-top: 20px;">Feedbacks</h2>

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

                        <ul class="list-inline d-sm-flex my-0">
                            
                            <li class="list-inline-item ml-auto">
                        
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        ';
            }
            ?>



        </div>
    </div>


</body>

</html>