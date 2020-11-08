<form>
    <fieldset>
        <br><h3 class="text-center">Add new Staff Data</h3><br>
        
        <div class="row">
            <div class="form-group col">
                <label for = "fname"><b>First Name:</b></label>
                <input type = "text" id = "fname" name = "fname" class="form-control">
                <div id="fname-feedback"></div>
            </div>

            <div class="form-group col">
                <label for = "lname"><b>Last Name:</b></label>
                <input type = "text" id = "lname" name = "lname" class="form-control">
                <div id="lname-feedback"></div>
            </div>
        </div>

        <div class="form-group">
            <label for = "gender"><b>Gender:</b></label>
            <div class="form-check">
                <input type = "radio" class="form-check-input" id = "gender_male" name = "gender" value = "male" checked>
                <label for = "male" class="form-check-label">Male</label>
            </div>
            <div class="form-check">
                <input type = "radio" class="form-check-input" id = "gender_female" name = "gender" value = "female">
                <label for = "female" class="form-check-label">Female</label>
            </div>
            <div id="gender-feedback"></div>
        </div>

        <div class="form-group">
            <label for = "birthday"><b>Date of Birth:</b></label>
            <input type = "date" class="form-control" id = "birthday" name = "birthday">
            <div id="birthday-feedback"></div>
        </div>

        <div class="form-group">                    
            <label for = "phone"><b>Phone number:</b></label>
            <input type = "tel" class="form-control" id = "phone" name = "phone" placeholder = "012-3456789">
            <div id="phone-feedback"></div>
        </div>

        <div class="form-group">
            <label for = "email"><b>Email:</b></label>
            <input type = "email" class="form-control" id = "email" name = "email" placeholder = "example@gmail.com">
            <div id="email-feedback"></div>
        </div>
        
        <div class="form-group">
            <label for = "username"><b>Username:</b></label>
            <input type = "text" class="form-control" id = "username" name = "username">
            <div id="username-feedback"></div>
        </div>

        <div class="form-group">
            <label for = "password"><b>Password:</b></label>
            <input type = "password" class="form-control" id = "password" name = "password">
            <input type="checkbox" id="showpassword"> Show Password<br>
            <div id="password-feedback"></div>
        </div>

        <div class="form-group">
            <label for = "confirm_password"><b>Confirm Password:</b></label>
            <input type = "password" class="form-control" id = "confirm_password" name = "password">
            <input type="checkbox" id="showconfirmpassword"> Show Password<br>
            <div id="confirmPassword-feedback"></div>
        </div>

        <div class="form-group">
            <label for = "position"><b>Position:</b></label>
            <select id="position" name="position" class="form-control">
            <?php
                //database connection
                $connect = new mysqli("localhost","root","","rms_database");

                //check connection
                if($connect->connect_error){
                    die("Connection error : $connect->connect_errno : $connect->connect_error");
                }

                if($statement = $connect->prepare("SELECT * FROM position")){
                    $statement->execute();
                    $result = $statement->get_result();

                    while($row = $result->fetch_array()){
                        echo '<option value='.$row['position_id'].'>'.$row['position_id'].' - '.
                                $row['position_name'].'</option>';
                    }
                    $statement->close();
                }else{
                    die("Failed to prepare SQL statement.");
                }
                $connect->close();
                
            ?>
            </select>
            <div id="position-feedback"></div>
        </div>

        <button class="btn btn-block btn-primaryLight btn-primary" id="modal-submit">Add Staff</button>
        <button class="btn btn-block btn-primaryLight btn-primary" id="modal-cancel">Cancel</button>
    </fieldset>
</form>