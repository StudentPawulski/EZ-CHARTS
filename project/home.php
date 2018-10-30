<?php
session_start();
require('authenticate.php');
echo print_r($_SESSION);
?>

<a href="creategraph.php">Create Graph</a>