<?php
    //get id from webpage
    $id = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");
    
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * FROM staff WHERE staff_id=? LIMIT 1")){
        $statement->bind_param("i",$id);
        $statement->execute();

        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            echo "<form>
                    <font size='6'>Edit Stock Data</font>
                    <div class='row'>
                        <div class='form-group col'>
                            <label for = 'fname'><b>First Name:</b></label>
                            <input type = 'text' id = 'fname' name = 'fname' class='form-control' value='".$row['first_name']."'>
                            <div id='fname-feedback'></div>
                        </div>

                        <div class='form-group col'>
                            <label for = 'lname'><b>Last Name:</b></label>
                            <input type = 'text' id = 'lname' name = 'lname' class='form-control' value='".$row['last_name']."'>
                            <div id='lname-feedback'></div>
                        </div>
                    </div>

                    <div class='form-group'>
                        <label for = 'gender'><b>Gender:</b></label>
                        <div class='form-check'>
                            <input type = 'radio' class='form-check-input' id = 'gender_male' name = 'gender' value = 'male' checked>
                            <label for = 'male' class='form-check-label'>Male</label>
                        </div>
                        <div class='form-check'>
                            <input type = 'radio' class='form-check-input' id = 'gender_female' name = 'gender' value = 'female'>
                            <label for = 'female' class='form-check-label'>Female</label>
                        </div>
                        <div id='gender-feedback'></div>
                    </div>

                    <div class='form-group'>
                        <label for = 'birthday'><b>Date of Birth:</b></label>
                        <input type = 'date' class='form-control' id = 'birthday' name = 'birthday' value='".$row['date_of_birth']."'>
                        <div id='birthday-feedback'></div>
                    </div>

                    <div class='form-group'>                    
                        <label for = 'phone'><b>Phone number:</b></label>
                        <input type = 'tel' class='form-control' id = 'phone' name = 'phone' placeholder = '012-3456789' value='".$row['phone_number']."'>
                        <div id='phone-feedback'></div>
                    </div>

                    <div class='form-group'>
                        <label for = 'email'><b>Email:</b></label>
                        <input type = 'email' class='form-control' id = 'email' name = 'email' placeholder = 'example@gmail.com' value='".$row['email']."'>
                        <div id='email-feedback'></div>
                    </div>
                    
                    <div class='form-group'>
                        <label for = 'username'><b>Username:</b></label>
                        <input type = 'text' class='form-control' id = 'username' name = 'username' value='".$row['username']."'>
                        <div id='username-feedback'></div>
                    </div>

                    <div class='form-group'>
                        <label for = 'position'><b>Position:</b></label>
                        <select id='position' name='position' class='form-control'>";

                            if($statement2 = $connect->prepare("SELECT * FROM position")){
                                $statement2->execute();
                                $result2 = $statement2->get_result();

                                while($row2 = $result2->fetch_array()){
                                    echo '<option value='.$row2['position_id'].'>'.$row2['position_id'].' - '.
                                            $row2['position_name'].'</option>';
                                }
                                $statement2->close();
                            }else{
                                die("Failed to prepare SQL statement.");
                            }

                    echo    "</select>
                        <div id='position-feedback'></div>
                    </div>
                
                    <button id='modal-submit' class='btn btn-block btn-primaryLight btn-primary'>Modify</button>
                    <button id='modal-cancel' class='btn btn-block btn-primaryLight btn-primary'>Cancel</button>			
                </form>
            ";
        }
    }else{
        die("Failed to prepare SQL statement.");
    }

    $statement->close();
    $connect->close();
?>