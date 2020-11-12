<?php
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $delivery_id = $_POST['delivery_id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("UPDATE delivery
                                        SET staff_longitude=?,staff_latitude=?
                                        WHERE delivery_id=?")){
        $statement->bind_param("ddi",$longitude,$latitude,$delivery_id);
        $statement->execute();
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
    $connect->close();
?>