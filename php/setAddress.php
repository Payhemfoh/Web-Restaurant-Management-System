<?php
    //get location
    $location_id = $_POST['location_id'];
    $location_address = $_POST['location_address'];
    $valid = true;

    if($valid){
        setcookie("location_id",$location_id);
        setcookie("location_address",$location_address);
    }
    //validate

    /*
    if($valid){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        if($statement = $connect->prepare("INSERT INTO menu VALUES (0,?,?,?,?);")){
            $statement->bind_param("sssd",$name,$description,$category,$price);
            $statement->execute();

            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }
    */
?>