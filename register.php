<?php
require('./php/connect.php');
$options = [
  'cost' => 11,
];

$username_from_post = '';
$password_from_post = '';
$email_from_post = '';

$username_taken_flag = false;

if (isset($_POST['username'])) {
  $username_from_post = $_POST['username'];
}

if (isset($_POST['password1'])) {
  if ($_POST['password1'] === $_POST['password2'])
    $password_from_post = $_POST['password1'];
  else {
    echo 'Passwords do not match, please try again';
  }
}

if (isset($_POST['email'])) {
  $email_from_post = $_POST['email'];
}


if (isset($_POST['username']) && isset($_POST['password'])) {
  $query = "SELECT username FROM userdata WHERE username = '$username_from_post' LIMIT 1";
  $statement = $db->prepare($query); // Returns a PDOStatement object.
  $statement->execute(); // The query is now executed.
  $userdata = $statement->fetchAll();

  echo print_r($userdata);

  if (count($userdata) === 1) {
    $username_taken_flag = true;
  }
}

// Sanitize user input to escape HTML entities and filter out dangerous characters.
if ($username_taken_flag == false) {
  if ($username_from_post != null && $password_from_post != null) {
    $username = filter_var($username_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($password_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email_from_post, FILTER_SANITIZE_EMAIL);
    //Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
    //set admin priv
    $isadmin = 0;
    $photo = null;
    // Build the parameterized SQL query and bind to the above sanitized values.
    $query = "INSERT INTO userdata (username, hashedPassword, isAdmin, photo, email) values (:username, :hashedpassword, :isadmin, :photo, :email)";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':hashedpassword', $hashed_password);
    $statement->bindValue(':isadmin', $isadmin);
    $statement->bindValue(':photo', $photo);
    $statement->bindValue(':email', $email);

    // Execute the INSERT.
    $statement->execute();

    direct();
  }
} else {
  echo 'username is already taken';
}

function direct()
{
  header('Location: confirmregistration.php');
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
    <STYLE type="text/css">
        a:not([href]):not([tabindex]), a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]):hover {
            color: inherit;
            text-decoration: none;
            margin-left: 30px;
        }
    </STYLE>
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
            <li class="nav-item active">
              <a class="nav-link" href="#"
                >Home <span class="sr-only">(current)</span>
              </a>
            </li>
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
                <i class="fa fa-twitter"></i>
              </a>
            </li>
            <li class="nav-item">
              <a
                href="https://github.com/StudentPawulski/EZ-CHARTS"
                class="nav-link border border-light rounded"
                target="_blank"
              >
                <i class="fa fa-github mr-2"></i>EZ-CHARTS GitHub
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
            <!-- Grid column -->
            <!-- Grid column -->
              <!-- Card -->
              <div class="card">
                <!-- Card content -->
                <div class="card-body">
                  <!-- Form -->
                  <form name="register" method="POST" action="register.php">
                    <!-- Heading -->
                    <h3 class="dark-grey-text text-center">
                      <strong>Register for your own account</strong>
                    </h3>
                    <hr />

                    <div class="md-form">
                      <i class="fa fa-user prefix grey-text"></i>
                      <input type="text" id="form3" class="form-control" name="username"/>
                      <label for="form3">User Name</label>
                    </div>

                    <div class="md-form">
                      <i class="fa fa-envelope prefix grey-text"></i>
                      <input type="email" id="form3" class="form-control" name="email"/>
                      <label for="form3">E-mail</label>
                    </div>
                    
                    <div class="md-form">
                      <i class="fa fa-key prefix grey-text"></i>
                      <input type="password" id="form2" class="form-control" name="password1"/>
                      <label for="form2">Password</label>
                    </div>

                    <div class="md-form">
                      <i class="fa fa-key prefix grey-text"></i>
                      <input type="password" id="form2" class="form-control" name="password2"/>
                      <label for="form2">Re-Enter Password</label>
                    </div>


                    <div class="text-center">
                      <button class="btn btn-indigo" type="submit">Submit</button>
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
