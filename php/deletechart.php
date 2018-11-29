<?php
require('authenticate.php');
require('connect.php');

function direct()
{
    header('Location: ../dashboard.php');
    exit;
}

if ($_GET['graphId'] != null) {
    $graphId = filter_var($_GET['graphId'], FILTER_SANITIZE_NUMBER_INT);
    $userid = $_SESSION['userid'];
}

$query = "DELETE FROM graphdata
            WHERE graphId = $graphId";
$statement = $db->prepare($query); // Returns a PDOStatement object.
$statement->execute(); // The query is now executed.

direct();
?>