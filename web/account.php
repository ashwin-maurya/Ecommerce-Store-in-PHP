<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
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
    <title>Your cart</title>
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/other.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/account.css?v=<?php echo time(); ?>">
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
        $full_name = $_POST['name'];
        $mobile_number = $_POST['number'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];

        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        } else {

            if ($_SESSION['user_id'] == $user) {
                $sql = "INSERT INTO `user_details` (`user_id`,`full_name`, `mobile_number`, `email`,`address`, `city`, `state`, `zip`,`datetime`) VALUES ('$user','$full_name','$mobile_number','$email','$address','$city','$state','$zip',current_timestamp());";

                $result = mysqli_query($conn, $sql);
            }

            if ($result) {
                echo '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: rgb(0, 255, 0); color:white;"><p style="margin:0 !important;margin-left:40px !important;">
          <strong>Success!</strong>Profile Details Submitted successfully!</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="hide()">
            <span aria-hidden="true"  >×</span>
          </button>
        </div>';
            } else {
                // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
                echo '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: rgb(255, 161, 161);"><p style="margin:0 !important;margin-left:40px !important;">
          <strong>Error!</strong> We are facing some technical issue and your order was not placed</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"  onclick="hide()">
            <span aria-hidden="true" >×</span>
          </button>
        </div>';
            }
        }
    }

    // $sql = "SELECT * from `user_details` ";
    $noResult = true;
    $sql = "SELECT * FROM `user_details` WHERE user_id=$user";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
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
    if (!$noResult) {

        echo '
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <div class="cont">
            <div class="col-xl-6 col-md-12" >
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="img-radius" alt="User-Profile-Image"> </div>
                                <h5 class="f-w-500"><b>' . $full_name . '</b></h5>
                                <h3><b>User</b></h3> 
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
<h6 class="m-b-20 p-b-5 b-b-default f-w-600"><span>Information</span><span>Edit</span> </h6>
                                <div class="row">
                                    <div class="col-sm-10">
                                        <p class="m-b-10 f-w-600">Email Id</p>
                                        <h6 class="text-muted f-w-400">' . $email . '</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone No.</p>
                                        <h6 class="text-muted f-w-400">' . $mobile_number . '</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="m-b-10 f-w-600">Address</p>
                                        <h6 class="text-muted f-w-400">' . $address . '</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">City</p>
                                        <h6 class="text-muted f-w-400">' . $city . '</h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">State</p>
                                        <h6 class="text-muted f-w-400">' . $state . '</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="m-b-10 f-w-600">Pin Code</p>
                                        <h6 class="text-muted f-w-400">' . $zip . '</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        <p class="m-b-10 f-w-600">Signup Date</p>
                                        <h6 class="text-muted f-w-400">' . $datetime . '</h6>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

';
    } else {
        echo '
    <div class="cont">
    <div class="container1">
    <div class="row">
        <div class="col-50">
            <div class="container" style="margin: 10px 90px 0 90px;">
                <div class="row">
                    <div class="col-50">
                        <h3>Enter your details</h3>
                        <div class="row">
                        <div class="col-50">
                        <form action="/web/account.php?user=' . $_SESSION['user_id']  . '&done" method="POST">
                        <label for="fname"> Full Name</label>
                        <input type="text" id="fname" name="name" placeholder="Rohan Das" value="' . $_SESSION['username']  . '" required>
                        </div>
                        <div class="col-50">
                        <label for="fname"> Mobile Number</label>
                        <input type="number" id="number" name="number" placeholder="99XXXXXXXX" required>
                        </div>
                        </div>
                        
                        <label for="fname">Email</label>
                        <input type="email" id="email" name="email" placeholder="abc@gmail.com" required>
                        <label for="adr"> Address</label>
                        <input type="text" id="adr" name="address" placeholder="542 W. 15th Street" required>
                        <label for="city"> City</label>
                        <input type="text" id="city" name="city" placeholder="New York">

                        <div class="row">
                            <div class="col-50">
                                <label for="state">State</label>
                                <select id="state" name="state" required>
                                    <option selected disabled value="">State</option>
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
                                <input type="text" id="zip" name="zip" placeholder="412105" required>
                            </div>
                        </div>
                    </div>
                </div>
                <label>
                                        </label>
                    <button type="submit" name="submit" class="btn" value="Submit">Fill details</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
    ';
    }

    ?>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script src="js/index.js"></script>

</body>

</html>
</script>
</body>

</html>