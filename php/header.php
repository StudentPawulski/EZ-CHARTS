<?php

?>

<header>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="index.php"
            target="_blank">
            <strong class="blue-text">EZ-CHARTS</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link waves-effect" href="
                    <?php if (isset($_SESSION['userid'])) : ?>
                        <?= 'dashboard.php' ?>
                    <?php else : ?>
                        <?= 'publiccharts.php' ?>
                    <?php endif ?>">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="https://mdbootstrap.com/material-design-for-bootstrap/"
                        target="_blank">About EZ-CHARTS</a>
                </li>
            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <a
                href="https://twitter.com/ChartsEz"
                class="nav-link"
                target="_blank"
              >
              <i class="fab fa-twitter mr-3"></i>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="https://github.com/StudentPawulski/EZ-CHARTS"
                class="nav-link border border-light rounded"
                target="_blank"
              >
              <i class="fab fa-github mr-3"></i>EZ-CHARTS GitHub
              </a>
            </li>
          </ul>
        </div>

    </div>
</nav>
<!-- Navbar -->

<!-- Sidebar -->
<div class="sidebar-fixed position-fixed">

    <a class="logo-wrapper waves-effect">
        <img src="img/EZ.png" class="img-fluid" alt="EZ-CHARTS LOGO">
    </a>
    <div class="list-group list-group-flush">
        
        <a href="#" class="list-group-item list-group-item-action waves-effect">
            <i class="fas fa-tachometer-alt mr-3"></i>Dashboard</a>
        <?php if (isset($_SESSION['userid'])) : ?>
            <a href="#" class="list-group-item list-group-item-action waves-effect">
                <i class="fa fa-user mr-4"></i>Profile</a>
        <?php endif ?>

        <?php if (isset($_SESSION['isAdmin'])) : ?>
            <?php if ($_SESSION['isAdmin'] == true) : ?>
            <a href="admintools.php" class="list-group-item list-group-item-action waves-effect">
                <i class="fa fa-user-plus mr-3"></i>Admin Tools</a>
                <?php endif ?>
        <?php endif ?>

        <?php if (isset($_SESSION['userid'])) : ?>
        <a href="createchart.php" class="list-group-item list-group-item-action waves-effect">
            <i class="fa fa-table mr-3"></i>Create Chart</a>
        <?php endif ?>

        <?php if (isset($_SESSION['userid'])) : ?>
        <a href="php/logout.php" class="list-group-item list-group-item-action waves-effect">
        <i class="fas fa-sign-out-alt mr-3"></i>Log Out</a>
        <?php endif ?>
    </div>

</div>
<!-- Sidebar -->

</header>