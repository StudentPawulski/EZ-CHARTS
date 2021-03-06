<?php

require('./php/authenticate.php');
require('./php/connect.php');

$graphId;

if ($_GET['graphId'] != null) {
    $graphId = filter_var($_GET['graphId'], FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['graphId'] = $graphId;
    $userid = $_SESSION['userid'];
}

if ($_POST) {
    $title_from_post = '';
    $type_from_post = '';
    $is_public_from_post = '';
    $x_axis_name_from_post = '';
    $y_axis_name_from_post = '';
    $x_axis_from_post = array_fill(1, 12, null);
    $y_axis_from_post = array_fill(1, 12, null);
    $x_axis = array_fill(1, 12, null);
    $y_axis = array_fill(1, 12, null);
    if (isset($_POST['title'])) {
        $title_from_post = $_POST['title'];
    }
    if (isset($_POST['type'])) {
        $type_from_post = $_POST['type'];
    }
    if (isset($_POST['public'])) {
        if ($_POST['public'] == false)
            $is_public_from_post = 0;
        else {
            $is_public_from_post = 1;
        }
    }
    if (isset($_POST['xAxisName'])) {
        $x_axis_name_from_post = $_POST['xAxisName'];
    }
    if (isset($_POST['yAxisName'])) {
        $y_axis_name_from_post = $_POST['yAxisName'];
    }
    $a = 1;
    if (isset($_POST['xAxis' . $a])) {
        while ($_POST['xAxis' . $a] != null && $a <= 12) {
            $x_axis_from_post[$a] = $_POST['xAxis' . $a];
            $a++;
            if ($a === 13) {
                break;
            }
        }
    }
    $b = 1;
    if (isset($_POST['yAxis' . $b])) {
        while ($_POST['yAxis' . $b] != null && $b <= 12) {
            $y_axis_from_post[$b] = $_POST['yAxis' . $b];
            $b++;
            if ($b === 13) {
                break;
            }
        }
    }

    // $title_from_post . $type_from_post . $x_axis_name_from_post . $y_axis_name_from_post . $x_axis_from_post[1] . $y_axis_from_post[1];


    if ($title_from_post != null &&
        $type_from_post != null &&
        $x_axis_name_from_post != null &&
        $y_axis_name_from_post != null &&
        $x_axis_from_post[1] != null &&
        $y_axis_from_post[1] != null) {
        $owner_id = $_SESSION['userid'];
        $title = filter_var($title_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        $type = filter_var($type_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        $is_public = filter_var($is_public_from_post, FILTER_SANITIZE_NUMBER_INT);
        $x_axis_name = filter_var($x_axis_name_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        $y_axis_name = filter_var($y_axis_name_from_post, FILTER_SANITIZE_SPECIAL_CHARS);

        $a = 1;
        while ($x_axis_from_post[$a] != null) {
            $x_axis[$a] = filter_var($x_axis_from_post[$a], FILTER_SANITIZE_SPECIAL_CHARS);
            $a++;
            if ($a === 13) {
                break;
            }
        }
        $b = 1;
        while ($y_axis_from_post[$b] != null) {
            $y_axis[$b] = filter_var($y_axis_from_post[$b], FILTER_SANITIZE_NUMBER_FLOAT);
            $b++;
            if ($b === 13) {
                break;
            }
        }
        //Hash password
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "UPDATE graphdata 
                        SET title = :title, type = :type, isPublic = :isPublic,
                        xAxisName = :xAxisName, yAxisName = :yAxisName,
                        xAxis1 = :xAxis1, xAxis2 = :xAxis2, xAxis3 = :xAxis3,
                        xAxis4 = :xAxis4, xAxis5 = :xAxis5, xAxis6 = :xAxis6,
                        xAxis7 = :xAxis7, xAxis8 = :xAxis8, xAxis9 = :xAxis9,
                        xAxis10 = :xAxis10, xAxis11 = :xAxis11, xAxis12 = :xAxis12, 
                        yAxis1 = :yAxis1, yAxis2 = :yAxis2, yAxis3 = :yAxis3,
                        yAxis4 = :yAxis4, yAxis5 = :yAxis5, yAxis6 = :yAxis6,
                        yAxis7 = :yAxis7, yAxis8 = :yAxis8, yAxis9 = :yAxis9,
                        yAxis10 = :yAxis10, yAxis11 = :yAxis11, yAxis12 = :yAxis12
                        WHERE graphId = :graphId";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':graphId', $_SESSION['graphId']);
        $statement->bindValue(':type', $type_from_post);
        $statement->bindValue(':isPublic', $is_public);
        $statement->bindValue(':xAxisName', $x_axis_name);
        $statement->bindValue(':yAxisName', $y_axis_name);

        for ($i = 1; $i < 13; $i++) {
            $statement->bindValue(':xAxis1', $x_axis[$i]);
            $statement->bindValue(':yAxis1', $y_axis[$i]);
        }

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
    header('Location: dashboard.php');
    exit;
}

if (!$_POST) {

    if (isset($_SESSION['isAdmin'])) {
        if ($_SESSION['isAdmin'] == true) {
            $query = "SELECT * FROM graphdata WHERE graphId = '$graphId'";
            $statement = $db->prepare($query); // Returns a PDOStatement object.
            $statement->execute(); // The query is now executed.
            $graphs = $statement->fetchAll();
        }
    } else {
        $query = "SELECT * FROM graphdata WHERE graphId = '$graphId' AND ownerId = '$userid'";
        $statement = $db->prepare($query); // Returns a PDOStatement object.
        $statement->execute(); // The query is now executed.
        $graphs = $statement->fetchAll();
    }


}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EZ-CHARTS Edit Chart</title>
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
                  <form name="editchart" method="POST" action="editchart.php">
                    <!-- Heading -->
                    <h3 class="dark-grey-text text-center">
                      <strong>Edit the chart data</strong>
                    </h3>
                    <hr />

                    <div class="md-form">
                      <input type="text" id="form4" class="form-control" name="title" value="<?= $graphs[0]['title'] ?>"/>
                      <label >Title</label>
                    </div>

                    <div class="md-form">
                        <select name="type" class="browser-default custom-select">
                            <option value="bar" selected>Bar</option>
                            <option value="line">Line</option>                            
                        </select>
                    </div>

                    <div class="md-form">
                        <select name="public" class="browser-default custom-select">
                            <option value="1" selected>Viewable By Public</option>
                            <option value="0">Private Chart</option>                            
                        </select>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxisName" value="<?= $graphs[0]['xAxisName'] ?>">
                      <label >X Axis Name</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="yAxisName" value="<?= $graphs[0]['yAxisName'] ?>">
                      <label >Y Axis Name</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis1" value="<?= $graphs[0]['xAxis1'] ?>"/>
                      <label >X Axis 1</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis2" value="<?= $graphs[0]['xAxis2'] ?>"/>
                      <label >X Axis 2</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis3" value="<?= $graphs[0]['xAxis3'] ?>"/>
                      <label >X Axis 3</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis4" value="<?= $graphs[0]['xAxis4'] ?>"/>
                      <label >X Axis 4</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis5" value="<?= $graphs[0]['xAxis5'] ?>"/>
                      <label >X Axis 5</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis6" value="<?= $graphs[0]['xAxis6'] ?>"/>
                      <label >X Axis 6</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis7" value="<?= $graphs[0]['xAxis7'] ?>"/>
                      <label >X Axis 7</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis8" value="<?= $graphs[0]['xAxis8'] ?>"/>
                      <label >X Axis 8</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis9" value="<?= $graphs[0]['xAxis9'] ?>"/>
                      <label >X Axis 9</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis10" value="<?= $graphs[0]['xAxis10'] ?>"/>
                      <label >X Axis 10</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis11" value="<?= $graphs[0]['xAxis11'] ?>"/>
                      <label >X Axis 11</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis12" value="<?= $graphs[0]['xAxis12'] ?>"/>
                      <label >X Axis 12</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis1" value="<?= $graphs[0]['yAxis1'] ?>" step="0.01"/>
                      <label >Y Axis 1</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis2" value="<?= $graphs[0]['yAxis2'] ?>" step="0.01"/>
                      <label >Y Axis 2</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis3" value="<?= $graphs[0]['yAxis3'] ?>" step="0.01"/>
                      <label >Y Axis 3</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis4" value="<?= $graphs[0]['yAxis4'] ?>" step="0.01"/>
                      <label >Y Axis 4</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis5" value="<?= $graphs[0]['yAxis5'] ?>" step="0.01"/>
                      <label >Y Axis 5</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis6" value="<?= $graphs[0]['yAxis6'] ?>" step="0.01"/>
                      <label >Y Axis 6</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis7" value="<?= $graphs[0]['yAxis7'] ?>" step="0.01"/>
                      <label >Y Axis 7</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis8" value="<?= $graphs[0]['yAxis8'] ?>" step="0.01"/>
                      <label >Y Axis 8</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis9" value="<?= $graphs[0]['yAxis9'] ?>" step="0.01"/>
                      <label >Y Axis 9</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis10" value="<?= $graphs[0]['yAxis10'] ?>" step="0.01"/>
                      <label >Y Axis 10</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis11" value="<?= $graphs[0]['yAxis11'] ?>" step="0.01"/>
                      <label >Y Axis 11</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis12" value="<?= $graphs[0]['yAxis12'] ?>" step="0.01"/>
                      <label >Y Axis 12</label>
                    </div>

                    <div class="text-center">
                      <button class="btn btn-indigo" type="submit">Submit</button>
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