<?php
    function passwordEncrypt(string $password):string{
        return hash("sha256",$password."Welcome To Restaurant Management Module");
    }

    //get post value from webpage
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = "";
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $phoneNo = $_POST['phoneNo'];
    $valid = true;

    //<---------------------Start Validation--------------------->
    if(empty($fname))
    {
        echo "<h3><font color = 'red'>Your first name is empty.</font></h3>";
        $valid = false;
    }
    
    if(empty($lname))
    {
        echo "<h3><font color = 'red'>Your last name is empty.</font></h3>";
        $valid = false;
    }
    
    if(empty($gender))
    {
        echo "<h3><font color = 'red'>Your gender is not selected.</font></h3>";
        $valid = false;
    }

    if(empty($birthday))
    {
        echo "<h3><font color = 'red'>Your date of birth is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($phoneNo))
    {
        echo "<h3><font color = 'red'>Your phone number is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($email))
    {
        echo "<h3><font color = 'red'>Your email is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($username))
    {
        echo "<h3><font color = 'red'>Your username is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($password))
    {
        echo "<h3><font color = 'red'>Your password is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($confirm_Password))
    {
        echo "<h3><font color = 'red'>Your confirm password is empty. This field is required.</font></h3>";
        $valid = false;
    }

    //advance checking
    if($confirm_Password!==$password){
        echo "<h3><font color = 'red'>Password not match with Confirm Password field.</font></h3>";
        $valid = false;
    }
    
    if(!ctype_alpha($fname))
    {
        echo "<h3><font color = 'red'>Your first name all must be alphabet.</font></h3>";
        $valid = false;
    }
    
    if(!ctype_alpha($lname))
    {
        echo "<h3><font color = 'red'>Your last name all must be alphabet.</font></h3>";
        $valid = false;
    }
    
    if(!preg_match("/^[0-9]{3}-[0-9]{7}$/", $phoneNo))
    {
        echo "<h3><font color = 'red'>Your phone number is invalid.</h3></font>";
        $valid = false;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "<h3><font color = 'red'>Invalid email format.</h3></font>";
        $valid = false;
    }

    if($valid){
        //perform static password salting and hash encryption
        $hashed = passwordEncrypt($password);

        //database connection
        $connect = new mysqli("localhost","root","","rms_database");
        
        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        //use parameterized query to prevent sql injection
        //insert data into stock table
        if($statement = $connect->prepare("INSERT INTO customer VALUES(0,?,?,?,?,?,?,?,?,?);")){
            $statement->bind_param("dsssssssss",
                                    $username,
                                    $hashed,
                                    $email,
                                    $fname,
                                    $lname,
                                    $address,
                                    $gender,
                                    $birthday,
                                    $phoneNo);
            $statement->execute();

            echo "<p>The data had been added into database.</p><br>";
            echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Menu</button>";
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }else{
        echo "<p>Failed to insert data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Try Again</button>";
    }
?>