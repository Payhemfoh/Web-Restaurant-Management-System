<?php
    function passwordEncrypt(string $password):string{
        return hash("sha256",$password."Welcome To Restaurant Management Module");
    }

    //This page receive the data from register.html.
    //It will receive first name, last name, gender, DOB, phone number, email, username, password, confirm password.

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_Password = $_POST['confirmPassword'];
    $address = "";
    $valid = true;


    //<---------------------Start Validation--------------------->
    if(empty($fname)){
        echo "<h3><font color = 'red'>Your first name is empty.</font></h3>";
        $valid = false;
    }
    
    if(empty($lname)){
        echo "<h3><font color = 'red'>Your last name is empty.</font></h3>";
        $valid = false;
    }
    
    if(empty($gender)){
        echo "<h3><font color = 'red'>Your gender is not selected.</font></h3>";
        $valid = false;
    }

    if(empty($birthday)){
        echo "<h3><font color = 'red'>Your date of birth is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($phone)){
        echo "<h3><font color = 'red'>Your phone number is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($email)){
        echo "<h3><font color = 'red'>Your email is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($username)){
        echo "<h3><font color = 'red'>Your username is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($password)){
        echo "<h3><font color = 'red'>Your password is empty.</font></h3>";
        $valid = false;
    }
    
    if (empty($confirm_Password)){
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
    
    if(!preg_match("/^[0-9]{3}-[0-9]{7}$/", $phone))
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
        //perform static password salting and hashing
        $hashed = passwordEncrypt($password);

        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        //use parameterized query to prevent sql injection
        //check customer table
        if($statement = $connect->prepare("INSERT INTO customer VALUES(0,?,?,?,?,?,?,?,?,?);")){
            $statement->bind_param("sssssssss",
                                    $username,
                                    $hashed,
                                    $email,
                                    $fname,
                                    $lname,
                                    $address,
                                    $gender,
                                    $birthday,
                                    $phone);
            $statement->execute();

            echo "<p>Hi, <font color=\"red\">$username</font>, your registration is successful!".
                " Please click the button below to login:</p>";
            echo "<a href=\"../webpage/login.php\" class=\"btn btn-block btn-lg btn-outline-primary\">Login</a>";

            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }else{
        echo "<p>Failed to register! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Try Again</button>";
    }
