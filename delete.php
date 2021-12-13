<?php require 'header.php'?>

<?php

require 'dbconnect.php';

$id = $_GET['id'];

$sql = 'DELETE FROM Student WHERE StdID=:id';
$stmt = $db->prepare($sql);
if ($stmt->execute([':id' => $id])) {
    echo <<<HTM
    <p style="padding:5px; background-color: green; color: white">The record has been successfully deleted!</p>
    <a href="index.php">Back To Homepage</a>
    HTM;

}


?>


<?php require 'footer.php'?>