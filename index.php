<?php
require('./php/connect.php');
$username_from_post = '';
$password_from_post = '';

if (isset($_POST['username'])) {
  $username_from_post = $_POST['username'];
}

if (isset($_POST['password'])) {
  $password_from_post = $_POST['password'];
}

if ($username_from_post != null && $password_from_post != null) {
  $username = filter_var($username_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_var($password_from_post, FILTER_SANITIZE_SPECIAL_CHARS);

  $query = "SELECT userid, username, hashedPassword, isAdmin FROM userdata WHERE username = '$username' LIMIT 1";
  $statement = $db->prepare($query); // Returns a PDOStatement object.
  $statement->execute(); // The query is now executed.
  $userdata = $statement->fetchAll();


  if (count($userdata) === 1) {
    $user = $userdata[0];
    $hashed_password_from_DB = $user['hashedPassword'];
    if (password_verify($password_from_post, $hashed_password_from_DB)) {
      echo 'Password is correct!';
      session_start();
      $_SESSION['userid'] = $user['userid'];
      $_SESSION['username'] = $user['username'];
      if ($user['isAdmin'] == 1) {
        $_SESSION['isAdmin'] = true;
      }
      direct();
    } else {
      echo 'Incorrect password. Log in attempt failed';
    }
  }

}

function direct()
{
  header('Location: ./dashboard.php');
  exit;
}

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
                target="_blank"
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
      <div
        class="mask rgba-black-light d-flex justify-content-center align-items-center"
      >
        <!-- Content -->
        <div class="container">
          <!-- Grid row -->
          <div class="row wow fadeIn">
            <!-- Grid column -->
            <div class="col-md-6 mb-4 white-text text-center text-md-left">
              <h1 class="display-4 font-weight-bold">
                EZ-CHARTS
              </h1>

              <hr class="hr-light" />

              <p><strong>A simple and elegant way to display data</strong></p>

              <p class="mb-4 d-none d-md-block">
                <strong
                  >Not a member? You can still view public charts by clicking the button below
                </strong>
              </p>

              <a
                target="_blank"
                href="./publiccharts.php"
                class="btn btn-indigo btn-lg"
                >Public Charts <i class="fa fa-graduation-cap ml-2"></i>
              </a>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-6 col-xl-5 mb-4">
              <!-- Card -->
              <div class="card">
                <!-- Card content -->
                <div class="card-body">
                  <!-- Form -->
                  <form name="login" method="POST" action="index.php">
                    <!-- Heading -->
                    <h3 class="dark-grey-text text-center">
                      <strong>Sign In</strong>
                    </h3>
                    <hr />

                    
                      <input type="text" id="form3" class="form-control" name="username"/>
                      <label for="form3">User Name</label>
                    
                    
                      <input type="password" id="form2" class="form-control" name="password"/>
                      <label for="form2">Password</label>
                    


                    <div class="text-center">
                      <button class="btn btn-indigo" type="submit">Sign In</button>
                      <a href="register.php" class="btn btn-secondary" role="button">New User Sign Up</a>
                      <hr />

                    </div>
                  </form>
                  <!-- Form -->
                </div>
              </div>
              <!-- /.Card -->
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
        <!-- Content -->
      </div>
      <!-- Mask & flexbox options -->
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
