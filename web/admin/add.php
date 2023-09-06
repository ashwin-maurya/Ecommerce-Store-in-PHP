<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="css/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/nav.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/add.css?v=<?php echo time(); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Add Products</title>

</head>

<body>
    <?php include 'partial/dbconnect.php'; ?>
    <?php include 'partial/nav.php'; ?>
    <?php include 'partial/sidebar.php'; ?>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['cat'];
        $name = $_POST['name'];
        $text = $_POST['text'];
        $price = $_POST['price'];

        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        } else {

            if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
                $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
                $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);


                $sql = "INSERT INTO `items` (`category_id`,  `product_name`, `product_desc`, `product_price`,`imageType`,`imageData`) VALUES ('$id', '$name', '$text', '$price','{$imageProperties['mime']}','{$imgData}');";
                $result = mysqli_query($conn, $sql);
            }
            if ($result) {
                echo '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: rgb(0, 255, 0); color:white;"><p style="margin-left:40px; margin-bottom:0;">
              <strong>Success!</strong> Your entry has been submitted successfully! </p>
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

    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Add Products</h3>
                        <form name="frmImage" enctype="multipart/form-data" class="requires-validation" action="/web/admin/add.php?user" method="post">

                            <div class="col-md-12">
                                <select class="form-select mt-3" name="cat" required>
                                    <option selected disabled value="">Product Category</option>
                                    <option value="1">Books</option>
                                    <option value="2">Bags and Luggage </option>
                                    <option value="3">Cloth and Accessories </option>
                                    <option value="4">Electronic appliances </option>
                                    <option value="5">Shoe's and Sandal's</option>
                                    <option value="6">Watch and bracelets </option>
                                </select>
                                <div class="valid-feedback">You selected a Category!</div>
                                <div class="invalid-feedback">Please select a Category!</div>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="name" placeholder="Product Name" required>
                                <div class="valid-feedback">This field is valid!</div>
                                <div class="invalid-feedback">This field cannot be blank!</div>
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" type="text" name="text" placeholder="Product Description" rows="3" required></textarea>
                                <div class="valid-feedback">This field is valid!</div>
                                <div class="invalid-feedback">This field cannot be blank!</div>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="number" name="price" min="1" placeholder="Product price" required>
                                <div class="valid-feedback">This field is valid!</div>
                                <div class="invalid-feedback">This field cannot be blank!</div>
                            </div>

                            <div class="col-md-12 mt-1">
                                <label for="formFile" class="form-label">Product Image </label>
                                <input class="form-control" type="file" name="userImage" id="formFile" style="padding: 3px 20px;">
                            </div>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>