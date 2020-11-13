<?php
    function passwordEncrypt(string $password):string{
        return hash("sha256",$password."Welcome To Restaurant Management Module");
    }

    //get post value from webpage
    $position = $_POST['position'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = "";
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $phoneNo = $_POST['phone'];
    $valid = true;

    //validation

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
        if($statement = $connect->prepare("INSERT INTO staff VALUES(0,?,?,?,?,?,?,?,?,?,?);")){
            $statement->bind_param("dsssssssss",
                                    $position,
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