<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/about1.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/other.css?v=<?php echo time(); ?>">

    <title>About</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_menu.php'; ?>
    <?php include 'partials/_other.php'; ?>
    <section class="about-us">

        <section class="about">
            <div class="container">
                <div class="row">
                    <h1 id="b-border"><a href="#">About Us</a></h1>
                    <div class="block"></div>
                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                        ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                        dolores et ea rebum. Stet clita kasd gubergren,
                        no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="row-1">
                    <div class="six columns">
                        <h3 id="b-border"><a href="#">Our Process</a></h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="six columns">
                        <h3 id="b-border"><a href="#">Our Approach</a></h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>
                <div class="row-1">
                    <div class="six columns">
                        <h3 id="b-border"><a href="#">Our Goal</a></h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                    <div class="six columns">
                        <h3 id="b-border"><a href="#">Our Mission</a></h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>
            </div>
        </section>


    </section>


    <?php include 'partials/_footer.php'; ?>
    <script src="js/index.js"></script>
</body>

</html>