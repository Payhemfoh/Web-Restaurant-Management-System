<?php
    //get id from webpage
    $id = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");
    
    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * FROM staff s,position p WHERE s.staff_id=? AND s.position_id = p.position_id LIMIT 1;")){
        $statement->bind_param("i",$id);
        $statement->execute();

        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            echo "<form>					
                <center><font size='6'>Delete Staff Data</font></center>

                <div class='row'>
                    <div class='form-group col'>
                        <label for = 'fname'><b>First Name:</b></label>
                        <input type = 'text' id = 'fname' name = 'fname' class='form-control' readonly value='".$row['first_name']."'>
                    </div>

                    <div class='form-group col'>
                        <label for = 'lname'><b>Last Name:</b></label>
                        <input type = 'text' id = 'lname' name = 'lname' class='form-control' readonly value='".$row['last_name']."'>
                    </div>
                </div>

                <div class='form-group'>
                    <label for = 'gender'><b>Gender:</b></label>";

                    if($row['gender']==="M"){
                    
                    echo"    <div class='form-check'>
                        <input type = 'radio' class='form-check-input' id = 'gender_male' name = 'gender' value = 'male' checked>
                        <label for = 'male' class='form-check-label'>Male</label>
                    </div>";
                    }else{
                    echo "<div class='form-check'>
                        <input type = 'radio' class='form-check-input' id = 'gender_female' name = 'gender' value = 'female' checked>
                        <label for = 'female' class='form-check-label'>Female</label>
                    </div>";
                    }
                
                echo "
                </div>

                <div class='form-group'>
                    <label for = 'birthday'><b>Date of Birth:</b></label>
                    <input type = 'date' class='form-control' id = 'birthday' name = 'birthday' readonly value='".$row['date_of_birth']."'>
                </div>

                <div class='form-group'>                    
                    <label for = 'phone'><b>Phone number:</b></label>
                    <input type = 'tel' class='form-control' id = 'phone' name = 'phone' readonly value='".$row['phone_number']."'>
                </div>

                <div class='form-group'>
                    <label for = 'email'><b>Email:</b></label>
                    <input type = 'email' class='form-control' id = 'email' name = 'email' readonly value='".$row['email']."'>
                </div>
                
                <div class='form-group'>
                    <label for = 'username'><b>Username:</b></label>
                    <input type = 'text' class='form-control' id = 'username' name = 'username' readonly value='".$row['username']."'>
                </div>

                <div class='form-group'>
                    <label for = 'position'><b>Position:</b></label>
                    <select id='position' name='position' class='form-control'>";

                        if($statement2 = $connect->prepare('SELECT * FROM position')){
                            $statement2->execute();
                            $result2 = $statement2->get_result();

                            while($row2 = $result2->fetch_array()){
                                if($row2['position_id']===$row['position_id']){
                                    echo '<option value='.$row2['position_id'].'>'.$row2['position_id'].' - '.
                                        $row2['position_name'].'</option>';
                                }
                            }
                            $statement2->close();
                        }else{
                            die('Failed to prepare SQL statement.');
                        }
                        
                echo    "</select>
                </div>

                <button id='modal-submit' class='btn btn-block btn-primaryLight btn-primary'>Delete Data</button>
                <button id='modal-cancel' class='btn btn-block btn-primaryLight btn-primary'>Cancel</button>
            </form>
            ";
        }
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }

    $connect->close();
?>