<?php
require('authenticate.php');

$title_from_post = '';
$type_from_post = '';
$is_public_from_post = '';
$x_axis_name_from_post = '';
$y_axis_name_from_post = '';

$x_axis1_from_post = '';
$x_axis2_from_post = '';
$x_axis3_from_post = '';
$x_axis4_from_post = '';
$x_axis5_from_post = '';
$x_axis6_from_post = '';
$x_axis7_from_post = '';
$x_axis8_from_post = '';
$x_axis9_from_post = '';
$x_axis10_from_post = '';
$x_axis11_from_post = '';
$x_axis12_from_post = '';
$y_axis1_from_post = null;
$y_axis2_from_post = null;
$y_axis3_from_post = null;
$y_axis4_from_post = null;
$y_axis5_from_post = null;
$y_axis6_from_post = null;
$y_axis7_from_post = null;
$y_axis8_from_post = null;
$y_axis9_from_post = null;
$y_axis10_from_post = null;
$y_axis11_from_post = null;
$y_axis12_from_post = null;

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



do {
    # code...
} while ($a <= 10);

?>

<form method="POST" action="creategraph.php" >
    <label>Title: </label>
    <input name="title" type="text">
    <br>
    <label>Type of Graph:</label>
    <input input name="type" type="text">
    <br>
    <label>Would you like the graph to be viewable by the public?</label>
    <input input name="public" type="checkbox">
    <br>
    <label>X Axis Name: </label>
    <input input name="xAxisName" type="text">
    <br>
    <label>Y Axis Name: </label>
    <input input name="yAxisName" type="text">
    <br>
    <label>X Axis 1: </label>
    <input input name="xAxis1" type="text">
    <br>
    <label>X Axis 2: </label>
    <input input name="xAxis2" type="text">
    <br>
    <label>X Axis 3: </label>
    <input input name="xAxis3" type="text">
    <br>
    <label>X Axis 4: </label>
    <input input name="xAxis4" type="text">
    <br>
    <label>X Axis 5: </label>
    <input input name="xAxis5" type="text">
    <br>
    <label>X Axis 6: </label>    
    <input input name="xAxis6" type="text">
    <br>
    <label>X Axis 7: </label>
    <input input name="xAxis7" type="text">
    <br>
    <label>X Axis 8: </label>
    <input input name="xAxis8" type="text">
    <br>
    <label>X Axis 9: </label>
    <input input name="xAxis9" type="text">
    <br>
    <label>X Axis 10: </label>
    <input input name="xAxis10" type="text">
    <br>
    <label>X Axis 11: </label>
    <input input name="xAxis11" type="text">
    <br>
    <label>X Axis 12: </label>
    <input input name="xAxis12" type="text">
    <br>
    <label>Y Axis 1: </label>
    <input input name="yAxis1" type="number" step="0.01">
    <br>
    <label>Y Axis 2: </label>
    <input input name="yAxis2" type="number" step="0.01">
    <br>
    <label>Y Axis 3: </label>
    <input input name="yAxis3" type="number" step="0.01">
    <br>
    <label>Y Axis 4: </label>
    <input input name="yAxis4" type="number" step="0.01">
    <br>
    <label>Y Axis 5: </label>
    <input input name="yAxis5" type="number" step="0.01">
    <br>
    <label>Y Axis 6: </label>
    <input input name="yAxis6" type="number" step="0.01">
    <br>
    <label>YAxis 7: </label>
    <input input name="yAxis7" type="number" step="0.01">
    <br>
    <label>Y Axis 8: </label>
    <input input name="yAxis8" type="number" step="0.01">
    <br>
    <label>Y Axis 9: </label>
    <input input name="yAxis9" type="number" step="0.01">
    <br>
    <label>Y Axis 10: </label>
    <input input name="yAxis10" type="number" step="0.01">
    <br>
    <label>Y Axis 11: </label>
    <input input name="yAxis11" type="number" step="0.01">
    <br>
    <label>Y Axis 12: </label>
    <input input name="yAxis12" type="number" step="0.01">
    <br>
    <input type="submit">
</form>