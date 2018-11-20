<?php
require('./php/authenticate.php');
require('./php/connect.php');

if (isset($_SESSION['userid'])) {
    $ownerId = $_SESSION['userid'];

    $query = "SELECT graphId, title, type , xAxisName, yAxisName FROM graphdata WHERE ownerId = '$ownerId'";
    $statement = $db->prepare($query); // Returns a PDOStatement object.
    $statement->execute(); // The query is now executed.
    $graphs = $statement->fetchAll();
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


                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-3 mb-4">


                    <!--Card-->
                    <div class="card mb-4">

                        <!--Card content-->
                        <div class="card-body">

                            <!-- List group links -->
                            <div class="list-group list-group-flush">


                                <?php if (isset($_SESSION['userid'])) : ?>
                                    <?php foreach ($graphs as $graph) : ?>
                                      
                                            <a class="list-group-item list-group-item-action waves-effect" 
                                                href="viewchart.php?graphId=<?= $graph['graphId'] ?>&p=<?= $graph['xAxisName'] ?>&l=<?= $graph['yAxisName'] ?>">
                                                <?= $graph['title'] ?>
                                                <span class="badge badge-success badge-pill pull-right"><?= $graph['type'] ?>
                                                <?php if ($graph['type'] == 'bar') : ?>
                                                    <i class="fa fa-bar-chart"></i>
                                                <?php elseif ($graph['type'] == 'line') : ?>
                                                    <i class="fa fa-line-chart"></i>
                                                <?php endif ?>
                                                </span>
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

            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row wow fadeIn">

            
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row wow fadeIn">


                <!--Grid column-->


                <!--Grid column-->



            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row wow fadeIn">

                
            </div>
            <!--Grid row-->

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