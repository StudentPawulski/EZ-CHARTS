<?php
session_start();
require('authenticate.php');
echo print_r($_SESSION);
?>
<h4>Login Successful!</h4>
<a href="creategraph.php">Create Graph</a>