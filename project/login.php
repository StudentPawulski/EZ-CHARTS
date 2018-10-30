<?php


require('connect.php');
$username_from_post = '';
$password_from_post = '';

if (isset($_POST['username'])) {
    $username_from_post = $_POST['username'];
}

if (isset($_POST['password'])) {
    $password_from_post = $_POST['password'];
}

if ($username_from_post != null && $password_from_post != null) {
    $username = filter_var($username_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_var($password_from_post, FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "SELECT userid, username, hashedPassword, isAdmin FROM userdata WHERE username LIKE '$username'";
    echo $query;
    $statement = $db->prepare($query); // Returns a PDOStatement object.
    $statement->execute(); // The query is now executed.
    $userdata = $statement->fetchAll();

    echo print_r($userdata);

    foreach ($userdata as $user) {
        if ($user['username'] == $username_from_post) {
            $hashed_password_from_DB = $user['hashedPassword'];
            if (password_verify($password_from_post, $hashed_password_from_DB)) {
                echo 'Password is correct!';
                session_start();
                $_SESSION['userid'] = $user['userid'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['hashedPassword'];
                $_SESSION['isAdmin'] = $user['isAdmin'];
                direct();
            } else {
                echo 'Incorrect password.';
            }
            echo print_r($_SESSION);
        }
    }
}

function direct()
{
    header('Location: http://localhost:31337/webproject/project/home.php');
    exit;
}

?>
<form method="POST" action="login.php" >
    <label>User Name:</label>
    <input name="username" type="text">
    <br>
    <label>Password</label>
    <input input name="password" type="text">
    <br>
    <input type="submit">
</form>