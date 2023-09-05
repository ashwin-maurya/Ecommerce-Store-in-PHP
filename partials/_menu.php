<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
echo '
<nav class="main-menu">
    <ul class="menu">
        <li>
            <a href="/web">
            
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="fa" fill="none" stroke="white" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span class="nav-text">Hello, ';
if ($loggedin) {
    echo $_SESSION['username'];
} else {
    echo 'User';
}

echo '  </span>
            </a>

        </li>
        <li>
            <a href="/web">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" class="fa" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                <span class="nav-text">
                    Home
                </span>
            </a>

        </li>';
if ($loggedin) {
    echo '
        <li class="has-subnav">
            <a href="account.php?user=' . $_SESSION['user_id'] . '">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"  class="fa" viewBox="0 0 24 24" fill="none" stroke="white" stroke="currentColor" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <span class="nav-text">
                  Your Account
                </span>
            </a>

        </li>';

    $sql = "SELECT * FROM `users` ";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $user = $row['user_id'];
    }
    echo '
        <li class="has-subnav">
            <a href="order.php?user=' . $_SESSION['user_id'] . '&catid=0">
            
<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" class="fa" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                <span class="nav-text">
                   Your Orders
                </span>
            </a>

        </li>
        <li class="has-subnav">
            <a href="cart.php?user=' . $_SESSION['user_id'] . '&t=0&catid=0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fa" viewBox="0 0 24 24" fill="none" stroke="white" stroke="currentColor"  stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <span class="nav-text">
                  Your Cart
                </span>
            </a>

        </li>
        
        <li>
        <a href="yourfeedback.php?&catid=0">
            
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fa" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            <span class="nav-text">
            Your Feedbacks
            </span>
        </a>
    </li>
   
        ';
}
echo '
        <li>';
if ($loggedin) {
    echo '<a href="contact.php?user=' . $_SESSION['user_id'] . '">';
}
if (!$loggedin) {
    echo '<a href="contact.php?">';
}

echo '
<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" class="fa" fill="none" stroke="currentColor" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <span class="nav-text">
                Review Us
                </span>
            </a>
        </li>

       
        
    </ul>

    <ul class="logout">';

if (!$loggedin) {
    echo '
    <li>
    <a href="/web/login.php?">
        

    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fa" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
        <span class="nav-text">
            Login
        </span>
    </a>
</li><li>
<a href="/web/signup.php?">
<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" class="fa" fill="none" stroke="white" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
    <span class="nav-text">
        Signup
    </span>
</a>
</li>
                  ';
} elseif ($loggedin) {
    echo '<li>
    <a href="/web/logout.php?">
<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" class="fa" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
        <span class="nav-text">
            Logout
        </span>
    </a>
</li>';
}
echo '
        
    </ul>
</nav>

';