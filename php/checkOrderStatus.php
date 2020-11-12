<?php
    $deliveryId = $_POST['deliveryId'];
    $record = new stdClass();

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT d.delivery_id,o.overall_status
                                        FROM delivery d, orders o
                                        WHERE d.delivery_id=?
                                        AND d.delivery_id = o.delivery_id")){
        $statement->bind_param("i",$deliveryId);
        $statement->execute();
        $result = $statement->get_result();
        while($row = $result->fetch_array()){
            $record->status = $row['overall_status'];
        }
        
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
    $connect->close();

    echo json_encode($record,JSON_FORCE_OBJECT);
?>