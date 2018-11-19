<?php

require('./php/authenticate.php');
require('./php/connect.php');

if (isset($_GET['graphId'])) {
    $graphId = filter_var($_GET['graphId'], FILTER_SANITIZE_NUMBER_INT);
    $userid = $_SESSION['userid'];
}

$query = "SELECT * FROM graphdata WHERE graphId = '$graphId' AND ownerId = '$userid'";
$statement = $db->prepare($query); // Returns a PDOStatement object.
$statement->execute(); // The query is now executed.
$graphs = $statement->fetchAll();

//echo print_r($graphs);
$type = $graphs[0]['type'];
$yAxisName = $graphs[0]['yAxisName'];
$AxisName = $graphs[0]['yAxisName'];
$title = $graphs[0]['title'];
//echo print_r($graphs);

$x_axis = []; //array_fill(1, 12, null);
$y_axis = []; //array_fill(1, 12, null);

for ($i = 1; $i < 13; $i++) {
    if ($graphs[0]['yAxis' . $i] != null ||
        $graphs[0]['xAxis' . $i] != null) {
        $x_axis[] = $graphs[0]['xAxis' . $i];
        $y_axis[] = (float)$graphs[0]['yAxis' . $i];
    } else {
        break;
    }
}

//consider doing some sort of append when you are filling the array.

$series = [
    'name' => $yAxisName,
    'data' => $y_axis
];

$title = [
    'text' => $title,
    'align' => 'center',
    'margin' => 20,
    'offsetY' => 20,
    'style' => [
        'fontSize' => '25px'
    ]
];
$xaxis = [
    'categories' => $x_axis
];

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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const series_data = <?= json_encode($series) ?>;
        const xaxis_data = <?= json_encode($xaxis) ?>;
        const title_data = <?= json_encode($title) ?>;
        const type = <?= json_encode($type) ?>;
    </script>
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

            <div class="card mb-4 wow fadeIn">
<!--Card content-->
                    <div class="card-body d-sm-flex justify-content-between">
                        <div class="container">
                            <div id="chart">
                                <script src="js/chart.js"></script>                             
                            </div>
                        </div>                        
                    </div>
                    <a href="dashboard.php" class="btn btn-primary" role="button" style="display:inline-block;width:200px">Home</a>
                    <a href="editchart.php?graphId=<?= $graphId ?>" class="btn btn-warning" role="button" style="display:inline-block;width:200px">Edit Chart</a>
                    <a href="php/deletechart.php?graphId=<?= $graphId ?>" class="btn btn-danger" role="button" style="display:inline-block;width:200px">Delete Chart</a> 
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