<?php
    $data = array();
    
    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("")){
        $statement->bind_param();
        $statement->execute();
        $result = $statement->get_result();
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }

    echo json_encode($data);

    $connect->close(); 
?>