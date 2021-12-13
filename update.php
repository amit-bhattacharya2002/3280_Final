<?php require 'header.php'?>

<?php

    require 'dbconnect.php';
    
    
    if(count($_POST)>0){
        $studid = $_POST['stud_id'];
        $studname = $_POST['stud_name'];
        $birthdate = $_POST['stud_dob'];
        $g = $_POST['gender_select'];
        $dep = $_POST['department'];

        $sql = "UPDATE Student SET StdID=$studid, SName='$studname', BirthDate='$birthdate', Gender='$g', Department='$dep' WHERE StdID ='$studid'";

        try {
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $affectedrows = $db->exec($sql);
            echo <<<HTM
    <p style="padding: 5px; background-color: green; color: white">The record has been updated successfully!</p>
    <a href="index.php">Back To Homepage</a>
    HTM;
        } catch (PDOException $e){
            echo "Couldn't update a row: ". $e->getMessage();
        }
    } else {

        $id = $_GET['id'];
        $sqlq = 'SELECT * FROM Student WHERE StdID=:id';
        $stmt = $db->prepare($sqlq);
        $stmt->execute(['id' => $id]);
        $student = $stmt->fetch(PDO::FETCH_OBJ);
    
        $studid = $student->StdID;
        $studname = $student->SName;
        $birthdate = $student->BirthDate;
        $g = $student->Gender;
        $dep = $student->Department;
    
            
        displayForm();

    }




    function displayForm() {
        global $studid;
        global $studname;
        global $birthdate;
        global $g;
        global $dep;

        $gender="";
        if($g == 'F'){
            $gender = '<input type="radio" name="gender_select" value="F" checked="checked">
            <label>Female</label><br><br>
            <input type="radio" name="gender_select" value="M">
            <label>Male</label><br><br>
            <input type="radio" name="gender_select" value="X">
            <label>Other</label><br><br>';
        } else if ($g == 'M'){
            $gender = '<input type="radio" name="gender_select" value="F">
            <label>Female</label><br><br>
            <input type="radio" name="gender_select" value="M" checked="checked">
            <label>Male</label><br><br>
            <input type="radio" name="gender_select" value="X">
            <label>Other</label><br><br>';
        } else if ($g == 'X'){
            $gender = '<input type="radio" name="gender_select" value="F">
            <label>Female</label><br><br>
            <input type="radio" name="gender_select" value="M">
            <label>Male</label><br><br>
            <input type="radio" name="gender_select" value="X" checked = "checked">
            <label>Other</label><br><br>';
        }


        $department = "";

        if($dep=="CSIS"){
            $department = '<select name="department" >
                     <option value="CSIS" selected>CSIS</option>
                     <option value="ART">ART</option>
                     <option value="MATH">MATH</option>
                     <option value="PHYS">PHYS</option>
                 </select>';
        } else if ($dep=="ART"){
            $department = '<select name="department" >
            <option value="CSIS">CSIS</option>
            <option value="ART" selected>ART</option>
            <option value="MATH">MATH</option>
            <option value="PHYS">PHYS</option>
        </select>';
        }else if ($dep=="MATH"){
            $department = '<select name="department" >
            <option value="CSIS">CSIS</option>
            <option value="ART">ART</option>
            <option value="MATH" selected>MATH</option>
            <option value="PHYS">PHYS</option>
        </select>';
        }else if ($dep=="PHYS"){
            $department = '<select name="department" >
            <option value="CSIS">CSIS</option>
            <option value="ART">ART</option>
            <option value="MATH">MATH</option>
            <option value="PHYS" selected>PHYS</option>
        </select>';
        }

        $form = <<<HTM

        <fieldset>
        <legend>Enter the information of a student</legend>
        <form action="update.php" method="POST">

            <div style="width: 400px;display: flex;justify-content: space-between;">
             <label>Student ID</label><input style="width: 200px;" type="number" name = "stud_id" value = $studid>
            </div> 
            <br>
            <div style="width: 400px; display: flex; justify-content: space-between ;">
             <label>Name</label><input value = "$studname" style="width: 200px;" type="text" name="stud_name" >
            </div>
            <br>
     
             <div style="width: 345px; display: flex; justify-content: space-between ;">
                 <label>Birthdate</label><input value = "$birthdate" type="date" name="stud_dob">
             </div>
             <br>

             <label style="width: 100px;">Gender</label><br><br>
             $gender
             
             <div style="width: 251px; display: flex; justify-content: space-between ;">
                 <label>Department</label>
                 $department
             </div>
             <br>

             <input type="submit" name="submitbtn" value="UPDATE">
         </form>
        </fieldset>

        HTM;

        echo $form;
    }
?>



<?php require 'footer.php'?>