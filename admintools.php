<?php
require('./php/authenticate.php');
require('./php/adminauth.php');
require('./php/connect.php');

if (isset($_SESSION['userid'])) {
    $ownerId = $_SESSION['userid'];

    $query = "SELECT graphId, title, username, type FROM graphdata, userdata where ownerId = userId";
    $statement = $db->prepare($query); // Returns a PDOStatement object.
    $statement->execute(); // The query is now executed.
    $graphs = $statement->fetchAll();


    $query = "SELECT userId, username, email ,photo FROM userdata";
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
    <title>EZ-CHARTS Dashboard</title>
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
                        <?php print_r($_SESSION) ?>
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
            <!-- Heading -->

            <!--Grid row-->
            <div class="row wow fadeIn">


                <!--Grid column-->
                <div class="col-md-3 mb-4">

                    <!--Card-->
                    <div class="card mb-4">

                        <!--Card content-->
                        <div class="card-body">

                            <!-- List group links -->
                            <div class="list-group list-group-flush">
                                
                                <h1>Charts</h1>

                                <?php if (isset($_SESSION['userid'])) : ?>
                                    <?php foreach ($graphs as $graph) : ?>
                                      
                                            <a class="list-group-item list-group-item-action waves-effect" 
                                                href="viewchart.php?graphId=<?= $graph['graphId'] ?>">
                                                <?= 'Chart Owner: ' . $graph['username'] ?>
                                                <span class="badge badge-success badge-pill pull-right"><?= $graph['type'] ?>
                                                <?php if ($graph['type'] == 'bar') : ?>
                                                    <i class="fa fa-bar-chart"></i>
                                                <?php elseif ($graph['type'] == 'line') : ?>
                                                    <i class="fa fa-line-chart"></i>
                                                <?php endif ?>
                                                </span>
                                                <h6><?= 'Chart title: ' . $graph['title'] ?></h6>
                                            </a>
                                        
                                    <?php endforeach ?>
                                <?php endif ?>


                            </div>
                            <!-- List group links -->

                        </div>

                    </div>
                    <!--/.Card-->

                </div>
                <!--Grid column-->




                <div class="col-md-6 mb-6">
                <div class="card mb-5">

                    <!--Card content-->
                    <div class="card-body">
                    
                        <!-- List group links -->
                        <div class="list-group list-group-flush">
                        <h1>Users</h1>

                            <?php if (isset($_SESSION['userid'])) : ?>
                                <?php foreach ($users as $user) : ?>
                                
                                        <a class="list-group-item list-group-item-action waves-effect" 
                                            href="edituser.php?userId=<?= $user['userId'] ?>">
                                            <?= 'User Name: ' . $user['username'] ?>                                            
                                            <h6><?= 'User Id: ' . $user['userId'] ?></h6>
                                            <h6><?= 'Email: ' . $user['email'] ?></h6>
                                            <h6><?= 'photo: ' . $user['photo'] ?></h6>
                                        </a>
                                    
                                <?php endforeach ?>
                            <?php endif ?>


                        </div>
                        <!-- List group links -->

                    </div>

                </div>
                    <!--/.Card-->

            
            </div>
            <!--Grid row-->
        </div>
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