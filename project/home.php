<?php
//session_start();
require('authenticate.php');
require('connect.php');

$ownerId = $_SESSION['userid'];

$query = "SELECT graphId, title FROM graphdata WHERE ownerId = '$ownerId'";
$statement = $db->prepare($query); // Returns a PDOStatement object.
$statement->execute(); // The query is now executed.
$graphs = $statement->fetchAll();



?>
<h4>Hello, <?= $_SESSION['username'] ?>. Enjoy your charts mate!</h4>
<a href="creategraph.php">Create Graph</a>

<?php foreach ($graphs as $graph) : ?>
<h3>
    <a href="viewgraph.php?graphId=<?= $graph['graphId'] ?>">
        <?= $graph['title'] ?>
    </a>
</h3>
<?php endforeach ?>