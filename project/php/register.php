<?php
require('connect.php');
$options = [
    'cost' => 11,
];

$username_from_post = '';
$password_from_post = '';
$email_from_post = '';

$username_taken_flag = false;

if (isset($_POST['username'])) {
    $username_from_post = $_POST['username'];
}

if (isset($_POST['password1'])) {
    if ($_POST['password1'] === $_POST['password2'])
        $password_from_post = $_POST['password1'];
    else {
        echo 'Passwords do not match, please try again';
    }
}

if (isset($_POST['email'])) {
    $email_from_post = $_POST['email'];
}


if (isset($_POST['username']) && isset($_POST['password'])) {
    $query = "SELECT username FROM userdata WHERE username = '$username_from_post' LIMIT 1";
    $statement = $db->prepare($query); // Returns a PDOStatement object.
    $statement->execute(); // The query is now executed.
    $userdata = $statement->fetchAll();

    echo print_r($userdata);

    if (count($userdata) === 1) {
        $username_taken_flag = true;
    }
}

// Sanitize user input to escape HTML entities and filter out dangerous characters.
if ($username_taken_flag == false) {
    if ($username_from_post != null && $password_from_post != null) {
        $username = filter_var($username_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($password_from_post, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($email_from_post, FILTER_SANITIZE_EMAIL);
    //Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
    //set admin priv
        $isadmin = 0;
        $photo = null;
    // Build the parameterized SQL query and bind to the above sanitized values.
        $query = "INSERT INTO userdata (username, hashedPassword, isAdmin, photo, email) values (:username, :hashedpassword, :isadmin, :photo, :email)";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':hashedpassword', $hashed_password);
        $statement->bindValue(':isadmin', $isadmin);
        $statement->bindValue(':photo', $photo);
        $statement->bindValue(':email', $email);

    // Execute the INSERT.
        $statement->execute();

        direct();
    }
} else {
    echo 'username is already taken';
}

function direct()
{
    header('Location: http://localhost:31337/webproject/project/confirmregister.php');
    exit;
}
//add a 2nd password field and validate

?>
<form method="POST" action="register.php" >
    <label>User Name:</label>
    <input name="username" type="text">
    <br>
    <label>E-mail:</label>
    <input name="email" type="email">
    <br>
    <label>Password:</label>
    <input input name="password1" type="password">
    <br>
    <label>Re-Enter Password:</label>
    <input input name="password2" type="password">
    <br>
    <input type="submit">
</form>
