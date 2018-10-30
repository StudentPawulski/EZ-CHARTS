<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {

    header('HTTP/1.1 401 Unauthorized');

    header('WWW-Authenticate: Basic realm="EZ_CHARTS"');

    exit("Access Denied: Username and password required.");
}
?>