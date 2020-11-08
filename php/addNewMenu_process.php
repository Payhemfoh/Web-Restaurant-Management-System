<?php
    //get post value from webpoge
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $valid = true;

    //validation

    
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
?>