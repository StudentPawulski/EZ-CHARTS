<?php
require('authenticate.php');
require('connect.php');

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
} else {
    echo 'Required fields are not complete';
}

//testing
function direct()
{
    header('Location: http://localhost:31337/webproject/project/home.php');
    exit;
}

?>

<form method="POST" action="creategraph.php" >
    <label>Title: </label>
    <input name="title" type="text">
    <br>
    <label>Type of Graph:</label>
        <select name = "type">
            <option value = "bar">Bar</option>
            <option value = "line">Line</option>
    </select>
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
    <label>Y Axis 7: </label>
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