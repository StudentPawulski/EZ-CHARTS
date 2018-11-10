<?php
require('authenticate.php');
require('connect.php');

if (isset($_GET['graphId'])) {
    $graphId = filter_var($_GET['graphId'], FILTER_SANITIZE_NUMBER_INT);
    $userid = $_SESSION['userid'];
}

$query = "SELECT * FROM graphdata WHERE graphId = '$graphId' AND ownerId = '$userid'";
$statement = $db->prepare($query); // Returns a PDOStatement object.
$statement->execute(); // The query is now executed.
$graphs = $statement->fetchAll();

//echo print_r($graphs);

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
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const series_data = <?= json_encode($series) ?>;
        const xaxis_data = <?= json_encode($xaxis) ?>;
        const title_data = <?= json_encode($title) ?>;
    </script>
</head>
<body>
<div class="container">
  <div id="chart"></div>
<script src="chart.js"></script>

<a href="editchart.php?graphId=<?= $graphId ?>">Edit Chart</a>
<a href="deletechart.php?graphId=<?= $graphId ?>">Delete Chart</a>
<br>
<a href="home.php">Home</a>
</form>
</body>
</html>