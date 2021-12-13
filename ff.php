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