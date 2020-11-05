<?php

    //This page receive the data from login.html.
    //It will receive username and password.

    $username = $_POST['username'];
    $password = $_POST['password'];
    $valid = true;
    //validate whether username and password is empty
    
    if (empty($username))
    {
        echo "<h3><font color = 'red'>Your username is empty.</font></h3>";
        $valid = false;
    }

    if(empty($password))
    {
        echo "<h3><font color = 'red'>Your password is empty.</font></h3>";
        $valid = false;
    }

    if($valid)
    {
        $found = false;
        //perform static password salting and hash encryption
        $hashed = passwordEncrypt($password);

        //database connection
        $connect = new mysqli("localhost","root","","rms_database");
        //use parameterized query to prevent sql injection
        //check customer table
        $statement = $connect->prepare("SELECT username,password FROM customer WHERE username LIKE ? AND password LIKE ?");
        $statement->bind_param("ss",$username,$hashed);
        $statement->execute();
        $result = $statement->get_result();
        if($result->num_rows>0){
            $found = true;
        }

        if(!$found){
            //check staff table
            $statement = $connect->prepare("SELECT username,password FROM staff WHERE username LIKE ? AND password LIKE ?");
            $statement->bind_param("ss",$username,$hashed);
            $statement->execute();
            $result = $statement->get_result();
            if($result->num_rows>0){
                $found = true;
            }
        }

        //create session and store the values
        if($found){
            session_start();
            $_SESSION['sess_username'] = $username;
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $_SESSION['date'] = date("d-m-Y: h:m:sA");
            $_SESSION['sess_timestamp'] = time();
            session_destroy();
            echo "<p>Congratulations! $username, you had login successfully.</p><br>";
            echo "<p>Click the button below to return to homepage</p><br>";
            echo "<a href=\"../webpage/homepage.php\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Homepage</a>";
        }else{
            echo "<p>Failed to login! Click the button below to try again.</p><br>";
            echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Try Again</button>";
        }
    }
?>