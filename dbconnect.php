<?php

$dbhostname = "mysql:host=localhost:8889;dbname=3280db";
$dbusername = "root";
$dbpassword = "root";


try{
    $db = new PDO($dbhostname,$dbusername,$dbpassword);
} catch (PDOException $e){
    echo "Could not connect to the database ". $e->getMessage();
}

?>
