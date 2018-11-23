<?php
require('./php/authenticate.php');
require('./php/connect.php');

$userId = $_SESSION['userid'];

$query = "SELECT username, email, photo FROM userdata WHERE userId = $userId";
$statement = $db->prepare($query); // Returns a PDOStatement object.
$statement->execute(); // The query is now executed.
$profile[0] = $statement->fetchAll();

$username = $profile['username'];
$email = $profile['email'];
$photo = $profile['photo'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EZ-CHARTS Profile Page</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
        ul.viewul {
            list-style-type: none;
            margin: 0 auto;
            padding: 0;
            overflow: hidden;
        }

        li.viewli {
            float: left;
        }

        li a.button {
            display: block;
            padding: 8px;            
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
                

                <div class="card-body d-sm-flex justify-content-between">

                    <h4 class="mb-2 mb-sm-0 pt-1">
                        <span>Profile</span>
                    </h4>
                    <h6>User Name: <?= $username ?></h6>
                    <h6>Email: <?= $email ?></h6>

                    <?php if ($photo == null) : ?>
                        <li class="viewli"><a href="photoupload.php" class="btn btn-warning" role="button" style="display:inline-block;width:200px">Upload Profile Pic</a></li>
                    <?php else : ?>
                        <img src="<?= $photo ?>" alt="Profile Picture">
                    <?php endif ?>                    
                        <li class="viewli"><a href="dashboard.php" class="btn btn-primary" role="button" style="display:inline-block;width:200px">Home</a></li>
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