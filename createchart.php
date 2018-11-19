<?php
require('./php/authenticate.php');
require('./php/connect.php');


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

if ($title_from_post != null &&
  $type_from_post != null &&
  $is_public_from_post != null &&
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
  $query = "INSERT INTO graphdata (ownerId, title, type, isPublic, xAxisName, yAxisName,
                            xAxis1, xAxis2, xAxis3, xAxis4, xAxis5, xAxis6,
                            xAxis7, xAxis8, xAxis9, xAxis10, xAxis11, xAxis12, 
                            yAxis1, yAxis2, yAxis3, yAxis4, yAxis5, yAxis6,
                            yAxis7, yAxis8, yAxis9, yAxis10, yAxis11, yAxis12
                            ) values (:ownerId, :title, :type, :isPublic, :xAxisName, :yAxisName,
                            :xAxis1, :xAxis2, :xAxis3, :xAxis4, :xAxis5, :xAxis6,
                            :xAxis7, :xAxis8, :xAxis9, :xAxis10, :xAxis11, :xAxis12, 
                            :yAxis1, :yAxis2, :yAxis3, :yAxis4, :yAxis5, :yAxis6,
                            :yAxis7, :yAxis8, :yAxis9, :yAxis10, :yAxis11, :yAxis12)";
  $statement = $db->prepare($query);
  $statement->bindValue(':ownerId', $owner_id);
  $statement->bindValue(':title', $title);
  $statement->bindValue(':type', $type_from_post);
  $statement->bindValue(':isPublic', $is_public);
  $statement->bindValue(':xAxisName', $x_axis_name);
  $statement->bindValue(':yAxisName', $y_axis_name);
  $statement->bindValue(':xAxis1', $x_axis[1]);
  $statement->bindValue(':xAxis2', $x_axis[2]);
  $statement->bindValue(':xAxis3', $x_axis[3]);
  $statement->bindValue(':xAxis4', $x_axis[4]);
  $statement->bindValue(':xAxis5', $x_axis[5]);
  $statement->bindValue(':xAxis6', $x_axis[6]);
  $statement->bindValue(':xAxis7', $x_axis[7]);
  $statement->bindValue(':xAxis8', $x_axis[8]);
  $statement->bindValue(':xAxis9', $x_axis[9]);
  $statement->bindValue(':xAxis10', $x_axis[10]);
  $statement->bindValue(':xAxis11', $x_axis[11]);
  $statement->bindValue(':xAxis12', $x_axis[12]);
  $statement->bindValue(':yAxis1', $y_axis[1]);
  $statement->bindValue(':yAxis2', $y_axis[2]);
  $statement->bindValue(':yAxis3', $y_axis[3]);
  $statement->bindValue(':yAxis4', $y_axis[4]);
  $statement->bindValue(':yAxis5', $y_axis[5]);
  $statement->bindValue(':yAxis6', $y_axis[6]);
  $statement->bindValue(':yAxis7', $y_axis[7]);
  $statement->bindValue(':yAxis8', $y_axis[8]);
  $statement->bindValue(':yAxis9', $y_axis[9]);
  $statement->bindValue(':yAxis10', $y_axis[10]);
  $statement->bindValue(':yAxis11', $y_axis[11]);
  $statement->bindValue(':yAxis12', $y_axis[12]);

    // Execute the INSERT.
  $statement->execute();
  direct();
} 
    /*else {
    echo 'Required fields are not complete';
}*/

//testing
function direct()
{
  header('Location: dashboard.php');
  exit;
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



            </div>
            <div class="card">
                <!-- Card content -->
                <div class="card-body">
                  <!-- Form -->
                  <form name="editchart" method="POST" action="createchart.php">
                    <!-- Heading -->
                    <h3 class="dark-grey-text text-center">
                      <strong>Edit the chart data</strong>
                    </h3>
                    <hr />

                    <div class="md-form">
                      <input type="text" id="form4" class="form-control" name="title" />
                      <label for="form3">Title</label>
                    </div>

                    <div class="md-form">
                        <select name="type" class="browser-default custom-select">
                            <option value="bar" selected>Bar</option>
                            <option value="line">Line</option>                            
                        </select>
                    </div>
                    
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="public" class="custom-control-input" id="defaultRegisterFormNewsletter">
                        <label class="custom-control-label" for="defaultRegisterFormNewsletter">Would you like the chart to be viewable by the public?</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxisName" >
                      <label for="form3">X Axis Name</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="yAxisName" >
                      <label for="form3">Y Axis Name</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis1" />
                      <label for="form2">X Axis 1</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis2" />
                      <label for="form2">X Axis 2</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis3" />
                      <label for="form2">X Axis 3</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis4" />
                      <label for="form2">X Axis 4</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis5" />
                      <label for="form2">X Axis 5</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis6" />
                      <label for="form2">X Axis 6</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis7" />
                      <label for="form2">X Axis 7</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis8" />
                      <label for="form2">X Axis 8</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis9" />
                      <label for="form2">X Axis 9</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis10" />
                      <label for="form2">X Axis 10</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis11" />
                      <label for="form2">X Axis 11</label>
                    </div>

                    <div class="md-form">
                      <input type="text" class="form-control" name="xAxis12" />
                      <label for="form2">X Axis 12</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis1" step="0.01"/>
                      <label for="form2">Y Axis 1</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis2" step="0.01"/>
                      <label for="form2">Y Axis 2</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis3" step="0.01"/>
                      <label for="form2">Y Axis 3</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis4" step="0.01"/>
                      <label for="form2">Y Axis 4</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis5" step="0.01"/>
                      <label for="form2">Y Axis 5</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis6" step="0.01"/>
                      <label for="form2">Y Axis 6</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis7" step="0.01"/>
                      <label for="form2">Y Axis 7</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis8" step="0.01"/>
                      <label for="form2">Y Axis 8</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis9" step="0.01"/>
                      <label for="form2">Y Axis 9</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis10" step="0.01"/>
                      <label for="form2">Y Axis 10</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis11" step="0.01"/>
                      <label for="form2">Y Axis 11</label>
                    </div>

                    <div class="md-form">
                      <input type="number" class="form-control" name="yAxis12" step="0.01"/>
                      <label for="form2">Y Axis 12</label>
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