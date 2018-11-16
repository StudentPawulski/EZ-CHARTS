<?php
session_start();
session_destroy();
direct();
function direct()
{
    header('Location: ../index.php');
    exit;
}
?>