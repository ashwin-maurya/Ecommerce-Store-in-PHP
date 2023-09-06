<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
} else {
    $loggedin = false;
}
echo '
<div class="sidebar">

<ul class="nav-links">
    <li>
        <a href="/web/admin/dashboard.php" class="active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="/web/admin/add.php" class="active">
            <i class="bx bx-plus" style="font-size:23px;"></i>
            <span class="links_name">Add Products</span>
        </a>
    </li>
    <li>
        <a href="/web/admin/product.php?catid=0">
            <i class="bx bx-shopping-bag"></i>
            <span class="links_name">Products</span>
        </a>
    </li>
    <li>
        <a href="/web/admin/users.php?catid=0">
            <i class="bx bx-user"></i>
            <span class="links_name">Users</span>
        </a>
    </li>
    <li>
        <a href="/web/admin/totalorders.php">
            <i class="bx bx-cart"></i>
            <span class="links_name">Total order</span>
        </a>
    </li>
    <li>
        <a href="/web/admin/messages.php">
            <i class="bx bx-message"></i>
            <span class="links_name">Feedbacks</span>
        </a>
    </li>
   
    <li class="log_out">
        <a href="/web/admin/logout.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Log out</span>
        </a>
    </li>
</ul>
</div>
';