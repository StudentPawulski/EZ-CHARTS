<?php
if (!isset($_SESSION['isAdmin'])) {
    //header redirection to login script
    header('HTTP/1.1 401 Unauthorized');
    //consider saving the current url to session if they are deeply nested in site

    exit("Access Denied: Username and password required.");
}
?>