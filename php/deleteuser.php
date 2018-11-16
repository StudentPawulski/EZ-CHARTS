<?php
require('authenticate.php');
require('adminauth.php');
require('connect.php');

function direct()
{
    header('Location: http://localhost:31337/webproject/admintools.php');
    exit;
}

if ($_GET['userId'] != null) {
    $userId_from_get = filter_var($_GET['userId'], FILTER_SANITIZE_NUMBER_INT);
}

$query = "DELETE FROM userdata
            WHERE userId = $userId_from_get";
$statement = $db->prepare($query); // Returns a PDOStatement object.
$statement->execute(); // The query is now executed.

direct();
?>