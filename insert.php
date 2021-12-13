<?php require 'header.php'?>
<?php

include 'dbconnect.php';

$nameErr="";
$idErr="";
$deptErr="";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(!validateForm()){
        showCorrectionsForm();
    }else {

        processForm();
    }
} else {
    displayForm();
}


function displayForm() {

    $form = '<fieldset>
    <legend>Enter the information of a student</legend>
    <form method="POST">

        <div style="width: 400px; height: 30px; display: flex;justify-content: space-between; align-items: center;">
         <label>Student ID</label><input style="width: 200px;" type="numberz " name = "stud_id" >
        </div> 
        <br>
        <div style="width: 400px; display: flex; justify-content: space-between ;align-items: center; height: 30px;">
         <label>Name</label><input style="width: 200px;" type="text" name="stud_name" >
        </div>
        <br>
 
         <div style="width: 400px; display: flex; justify-content: space-between ;">
             <label>Birthdate</label><input type="date" name="stud_dob">
         </div>
         <br>

         <label style="width: 100px;">Gender</label><br><br>
         <input type="radio" name="gender_select" value="F">
         <label>Female</label><br><br>
         <input type="radio" name="gender_select" value="M">
         <label>Male</label><br><br>
         <input type="radio" name="gender_select" value="X">
         <label>Other</label><br><br>
         
         <div style="width: 251px; display: flex; justify-content: space-between ; align-items:center;">
             <label>Department</label>
             <select name="department" >
                 <option value="CSIS">CSIS</option>
                 <option value="ART">ART</option>
                 <option value="MATH">MATH</option>
                 <option value="PHYS">PHYS</option>
             </select>
         </div>
         <br>

         <input type="submit" name="submitbtn" value="SUBMIT">
     </form>
    </fieldset>';

    echo $form;

}
function processForm() {

    global $db;

    $studid = $_POST['stud_id'];
    $studname = $_POST['stud_name'];
    $birthdate = $_POST['stud_dob'];
    $g = $_POST['gender_select'];
    $dep = $_POST['department'];

    $sql = "INSERT INTO Student VALUES($studid,'$studname','$birthdate','$g','$dep')";

    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $affectedrows = $db->exec($sql);
        echo "<p style='padding: 5px; background-color: green; color: white'>One record added successfully !!!</p> <br>";
    } catch (PDOException $e){
        echo "Couldn't insert a row: ". $e->getMessage();
    }


    echo <<<HTM

    <a href="index.php"><<<< Back to HomePage</a>

    HTM;
}
function validateForm() {

    global $nameErr, $idErr, $deptErr;
    $flag=true;
    $studid = $_POST['stud_id'];
    $studname = $_POST['stud_name'];
    $birthdate = $_POST['stud_dob'];
    $g = $_POST['gender_select'];
    $dep = $_POST['department'];

    if ($studid == null || !is_numeric($studid) ){
        $idErr = "Please enter a valid numeric id";
        $flag = false;
    }
    if ($studname == null){
        $nameErr = "Please enter a valid name";
        $flag = false;
    }
    if ($dep == null || $dep!="CSIS" && $dep!="ART" && $dep!="MATH" && $dep!="PHYS"){
        $deptErr = "Please select a valid department name from the given options (CSIS, ART, MATH, PHYS)";
        $flag = false;
    }
    return $flag;
}

function showCorrectionsForm(){

    global $nameErr, $idErr, $deptErr;

    echo'<fieldset>
    <legend>Enter the information of a student</legend>
    <form method="POST">

        <div style="width: 600px; height: 30px; display: flex;padding-right: 20px; align-items: center;">
         <label>Student ID</label><input style="width: 200px;" type="numberz " name = "stud_id" >
        ';if($idErr){echo '<div style="padding-left: 20px;"><p style="color: red">'.$idErr.'</p></div></div>';}else{echo '</div>';}
    echo '<br>
        <div style="width: 566px; height : 30px; display: flex; padding-right: 20px; align-items: center;">
         <label>Name</label><input style="width: 200px;" type="text" name="stud_name" >
        ';
        if($nameErr){echo '<div style="padding-left: 20px;"><p style="color: red">'.$nameErr.'</p></div></div>';}else{echo '</div>';}
    echo '<br>
 
         <div style="width: 338px; display: flex; justify-content: space-between ;">
             <label>Birthdate</label><input type="date" name="stud_dob">
         </div>
         <br>

         <label style="width: 100px;">Gender</label><br><br>
         <input type="radio" name="gender_select" value="F">
         <label>Female</label><br><br>
         <input type="radio" name="gender_select" value="M">
         <label>Male</label><br><br>
         <input type="radio" name="gender_select" value="X">
         <label>Other</label><br><br>
         
         <div style="width: 900px;display: flex; padding-right: 20px ;align-items:center;">
             <label>Department</label> 

    <select name="department" >
                 <option value="CSIS">CSIS</option>
                 <option value="ART">ART</option>
                 <option value="MATH">MATH</option>
                 <option value="PHYS">PHYS</option>
             </select>
         '; if($deptErr){echo '<div style="padding-left: 20px;"><p style="color: red">'.$deptErr.'</p></div></div>';}else{echo '</div>';}
    echo '<br>

         <input type="submit" name="submitbtn" value="SUBMIT">
     </form>
    </fieldset>';

}
?>


<?php require 'footer.php'?>