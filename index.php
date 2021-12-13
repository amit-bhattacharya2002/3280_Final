<?php require 'header.php'?>


<?php


include 'dbconnect.php';

echo <<<HTM

<a href="insert.php">Add new student</a><br>

HTM;

$sql = "SELECT * FROM Student";

try {
    $stmt = $db->query($sql);

    if($stmt === false){
        die("There was an error retrieving data !! ");
    }

} catch (PDOException $e){
    echo $e->getMessage();
}
$statement = $db->query($sql);
$chkarr = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!$chkarr == null){

    echo "<table> 
    <tr>
    <th>StudentID</th>
    <th>Name</th>
    <th>Birthdate</th>
    <th>Gender</th>
    <th>Department</th>";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>" . $row['StdID']. "</td>" ;
        echo "<td>" . $row['SName']. "</td>" ;
        echo "<td>" . $row['BirthDate']. "</td>" ;
        echo "<td>" . $row['Gender']. "</td>" ;
        echo "<td>" . $row['Department']. "</td>" ;
        echo "<td>" . "<a href='update.php?id=" .$row['StdID']. "'>Update</a> &nbsp; <a href='delete.php?id=" .$row['StdID']. "'>Delete</a> " . "</td>" ;
        echo "<tr>";
    }
} else {
    echo "No Records Found!!";
}



?>

<?php require 'footer.php'?>

