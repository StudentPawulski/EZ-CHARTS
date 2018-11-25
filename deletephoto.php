<?php
require('./php/authenticate.php');
require('./php/connect.php');

$userId = $_SESSION['userid'];

$query = "SELECT username, photo FROM userdata WHERE userId = $userId";
$statement = $db->prepare($query); // Returns a PDOStatement object.
$statement->execute(); // The query is now executed.
$delete = $statement->fetchAll();
$delete = $delete[0];

if (file_exists($delete['photo'])) {
    unlink($delete['photo']);
    $photo = null;

    $query = "UPDATE userdata 
            SET photo = :photo
            WHERE userId = :userId";
    $statement = $db->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':photo', $photo);
    // Execute the INSERT.
    $statement->execute();

    direct();
} else {
    direct();
}

function direct()
{
    header('Location: profile.php');
    exit;
}


?>