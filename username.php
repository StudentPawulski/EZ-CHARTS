<?php
  /* 
  This script actually checks the usernames in the db
  Returns JSON in this form: 
    { 
      'success': true/false,
      'usernameAvailable': true/false
    }
  Properties:
  - success             true unless a username is not provided in $_GET['username]
  - usernameAvailable   true if username is not present in $registered_usernames.
 */

require('./php/connect.php');

$query = "SELECT username FROM userdata";
$statement = $db->prepare($query); // Returns a PDOStatement object.
$statement->execute(); // The query is now executed.
$user_query_result = $statement->fetchAll();

$users = [];

for ($i = 0; $i < sizeof($user_query_result); $i++) {
    array_push($users, $user_query_result[$i][0]);
}

$registered_usernames = $users;
$response = [
    'success' => false,
    'usernameAvailable' => false
];
if (isset($_GET['username']) && (strlen($_GET['username']) !== 0)) {
    $response['usernameAvailable'] = !in_array($_GET['username'], $registered_usernames);
    $response['success'] = true;
} 
  // Set the JSON MIME content type so that it isn't sent as text/html
header('Content-Type: application/json');
  // Encode the $response into JSON and echo.
echo json_encode($response);
?>