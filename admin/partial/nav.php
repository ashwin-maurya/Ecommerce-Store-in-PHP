<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
echo '
<nav>
        <div class="sidebar-button">
            <span class="dashboard">Admin Dashboard</span>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Search...">
            <i class="bx bx-search"></i>
        </div>
        <div class="profile-details">
            <span class="admin_name">Welcome, Admin</span>
        </div>
    </nav>
';