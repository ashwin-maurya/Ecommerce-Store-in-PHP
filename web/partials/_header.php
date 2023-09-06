<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
echo '
<link rel="stylesheet" href="css/index1.css">

<div class="topnav" id="navbar">
            <div id="co">
    <img src="image/cart.svg" alt="">
';



if ($loggedin) {
    echo '
        <a href="cart.php?user=' . $_SESSION['user_id'] . '&t=0&catid=0">Your Cart</a>
        <a href="order.php?user=' . $_SESSION['user_id']  . '&catid=0">Orders</a>';
}
echo '
            </div>
            <div class="icons">';

if (!$loggedin) {
    echo '
                    <a class="nav-link icon" href="/web/login.php?">Login</a>
                  </li>
                 
                    <a class="nav-link" href="/web/signup.php?">Signup</a>
                  ';
} elseif ($loggedin) {
    echo '<li class="nav-item">
            <span>Hello, ';
    echo $_SESSION['username'];
    echo '  </span>
    <a class="nav-link icon" href="/web/logout.php?">Logout</a>
                  </li>';
}


echo '
            </div>
        </div>

        <div class="topnav1" id="navbar1">
            <div id="logo">
                 <img src="image/map.svg" alt="">
            </div>
            <div class="midnav">
                <div>
                    <div id="display">
                    <a href="/web" id="home">Home <span class="navb"></span></a>
                    <a href="about.php?" id="about">About Us<span class="navb"></span></a>';

if ($loggedin) {
    echo ' <a href="contact.php?user=' . $_SESSION['user_id'] . '" id="contact">Review Us<span class="navb"></span></a>';
}
if (!$loggedin) {
    echo '
                    <a href="contact.php?" id="contact">Review Us<span class="navb"></span></a>';
}
echo '        </div>
                </div>

              
            </div>
        </div>
';
