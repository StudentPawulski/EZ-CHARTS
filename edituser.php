<?php

require('./php/authenticate.php');
require('./php/adminauth.php');
require('./php/connect.php');

if ($_GET['userId'] != null) {
    $userId = filter_var($_GET['userId'], FILTER_SANITIZE_NUMBER_INT);
}

if ($_POST) {
    $userId_from_post = '';
    $username_from_post = '';
    $email_from_post = '';
    $photo_from_post = '';

    if (isset($_POST['userId'])) {
        $userId_from_post = $_POST['userId'];
    }

    if (isset($_POST['username'])) {
        $username_from_post = $_POST['username'];
    }

    if (isset($_POST['email'])) {
        $email_from_post = $_POST['email'];
    }

    if (isset($_POST['photo'])) {
        $photo_from_post = $_POST['photo'];
    }



    if ($userId_from_post != null &&
        $username_from_post != null &&
        $email_from_post != null) {
        $userid = filter_var($userId_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        $username = filter_var($username_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($email_from_post, FILTER_SANITIZE_NUMBER_INT);
        if (isset($_POST['photo'])) {
            $photo = filter_var($photo_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        //Hash password
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "UPDATE userdata 
                        SET userId = :userId, username = :username,
                        email = :email, photo = :photo
                        WHERE userId = :userId";
        $statement = $db->prepare($query);
        $statement->bindValue(':userId', $userid);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':photo', $photo);
    // Execute the INSERT.
        $statement->execute();

        direct();
    } else {
        echo '<script language="javascript">';
        echo 'alert("All required fields need to be completed")';
        echo '</script>';
            //header("Location: http://localhost:31337/webproject/project/editchart.php?graphId=" . $_SESSION['graphId']);
        exit;
    }
}

function direct()
{
    header('Location: admintools.php');
    exit;
}

if (!$_POST) {
    $query = "SELECT * FROM userdata";
    $statement = $db->prepare($query); // Returns a PDOStatement object.
    $statement->execute(); // The query is now executed.
    $users = $statement->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <STYLE type="text/css">
        a:not([href]):not([tabindex]), a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]):hover {
            color: inherit;
            text-decoration: none;
            margin-left: 30px;
        }
    </STYLE>
</head>

<body class="grey lighten-3">

    <!--Main Navigation-->
    <?php include('./php/header.php') ?>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">

            <!-- Heading -->
            <div class="card mb-4 wow fadeIn">

                <!--Card content-->
                <div class="card-body d-sm-flex justify-content-between">

                    <h4 class="mb-2 mb-sm-0 pt-1">
                        <span>Dashboard</span>
                    </h4>

                    <form class="d-flex justify-content-center">
                        <!-- Default input -->
                        <input type="search" placeholder="Type your query" aria-label="Search" class="form-control">
                        <button class="btn btn-primary btn-sm my-0 p" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                    
                </div>
                
            </div>
            <div class="card">
                <!-- Card content -->
                <div class="card-body">
                  <!-- Form -->
                  <form name="editchart" method="POST" action="edituser.php">
                    <!-- Heading -->
                    <h3 class="dark-grey-text text-center">
                      <strong>Edit User Data</strong>
                    </h3>
                    <hr />

                    <div class="md-form">
                      <input type="text" id="form4" class="form-control" name="userId" value="<?= $users[0]['userId'] ?>"/>
                      <label for="form3">User Id</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="username" value="<?= $users[0]['username'] ?>">
                      <label for="form3">User Name</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="email" value="<?= $users[0]['email'] ?>">
                      <label for="form3">Email Address</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="photo" value="<?= $users[0]['photo'] ?>"/>
                      <label for="form2">Photo</label>
                    </div>

                    <div class="text-center">
                      <button class="btn btn-indigo" type="submit">Submit</button>
                      <a href="php/deleteuser.php?userId=<?= $userId ?>" class="btn btn-danger btn-rounded" role="button">Delete User</a> 
                      <hr />
                    </div>
                  </form>
                  <!-- Form -->
                </div>
              </div>
            <!-- Heading -->

           
        </div>
    </main>
    <!--Main layout-->

    <?php include('./php/footer.php') ?>

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