<?php
    //get location
    $location_address = $_POST['location_address'];
    $valid = true;

    //validate
    if(empty($location_address)){
        echo "Location address is empty!<br>";
        $valid = false;
    }
    
    if($valid){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        if($statement = $connect->prepare("INSERT INTO delivery(delivery_id,customer_address) VALUES (0,?);")){
            $statement->bind_param("s",$location_address);
            $statement->execute();

            if(!isset($_SESSION)) session_start();
            
            $_SESSION['delivery_id'] = $connect->insert_id;
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }
    
?>