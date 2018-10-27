<?php
session_start();
?>
<form method="POST" action="login.php" >
    <label>User Name:</label>
    <br>
    <input name="username" type="text">
    <br>
    <label>Password</label>
    <br>
    <input input name="pass" type="password">
    <input type="submit">
</form>