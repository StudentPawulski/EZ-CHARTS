<?php

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>EZ-CHARTS</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet" />
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet" />
    <style type="text/css">
      html,
      body,
      header,
      .view {
        height: 100%;
      }

      @media (max-width: 740px) {
        html,
        body,
        header,
        .view {
          height: 1000px;
        }
      }

      @media (min-width: 800px) and (max-width: 850px) {
        html,
        body,
        header,
        .view {
          height: 650px;
        }
      }
      @media (min-width: 800px) and (max-width: 850px) {
        .navbar:not(.top-nav-collapse) {
          background: #1c2331 !important;
        }
      }
    </style>
  </head>

  <body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">
        <!-- Brand -->
        <a
          class="navbar-brand"
          href="index.php"
        >
          <strong>EZ-CHARTS</strong>
        </a>

        <!-- Collapse -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a
                class="nav-link"
                href="about.php"
                >About EZ-CHARTS</a
              >
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
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="https://github.com/StudentPawulski/EZ-CHARTS"
                class="nav-link border border-light rounded"
                target="_blank"
              >
                <i class="fab fa-github mr-2"></i>EZ-CHARTS GitHub
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Full Page Intro -->
    <div
      class="view full-page-intro"
      style="background-image: url('./img/charts.jpg'); background-repeat: no-repeat; background-size: cover;"
    >
      <!-- Mask & flexbox options -->
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
            <div class="card card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);">
                <div class="text-white text-center py-5 px-4 my-5">
                    <div>
                    <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Create beautiful charts with EZ-CHARTS</strong></h2>
                    <p class="mx-5 mb-5">EZ-CHARTS was created to allow users to create simple yet elegant charts.</p>
                    <p class="mx-5 mb-5">The charts can be easily exported to .PNG with the click of a button.</p>
                    <p class="mx-5 mb-5">This also allows users to use these charts instead of the boring old excel charts in their presentations.</p>
                    <p class="mx-5 mb-5">Have fun! The possibilities are endless.</p>
                    <a href="index.php" class="btn btn-outline-white btn-md"><i class="fa fa-clone left"></i>Home</a>
                    </div>
                </div>
            </div>            
        </div>
    </div>
    <!-- Full Page Intro -->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
      // Animations initialization
      new WOW().init();
    </script>
  </body>
</html>
