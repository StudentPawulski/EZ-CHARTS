<?php
require('connect.php');
$options = [
    'cost' => 11,
];

$username_from_post = '';
$password_from_post = '';

$username_taken_flag = false;

if (isset($_POST['username'])) {
    $username_from_post = $_POST['username'];
}

if (isset($_POST['password'])) {
    $password_from_post = $_POST['password'];
}


if (isset($_POST['username']) && isset($_POST['password'])) {
    $query = "SELECT username FROM userdata";
    $statement = $db->prepare($query); // Returns a PDOStatement object.
    $statement->execute(); // The query is now executed.
    $userdata = $statement->fetchAll();

    foreach ($userdata as $user) {
        if ($user['username'] == $username_from_post) {
            $username_taken_flag = true;
        }
    }
}


//echo $username_from_post;
//echo $password_from_post;
// Sanitize user input to escape HTML entities and filter out dangerous characters.
if ($username_taken_flag == false) {
    if ($username_from_post != null && $password_from_post != null) {
        $username = filter_var($username_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($password_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
    //Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
    //set admin priv
        $isadmin = 0;
        $photo = null;
    // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "INSERT INTO userdata (username, hashedPassword, isAdmin, photo) values (:username, :hashedpassword, :isadmin, :photo)";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':hashedpassword', $hashed_password);
        $statement->bindValue(':isadmin', $isadmin);
        $statement->bindValue(':photo', $photo);

    // Execute the INSERT.
        $statement->execute();
    }
} else {
    echo 'username is already taken';
}




?>
<form method="POST" action="register.php" >
    <label>User Name:</label>
    <br>
    <input name="username" type="text">
    <br>
    <label>Password</label>
    <br>
    <input input name="password" type="text">
    <input type="submit">
</form>
