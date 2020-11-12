<?php
    $delivery_id = $_POST['delivery_id'];

    $result = array();

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT delivery_id,staff_longitude,staff_latitude
                                        FROM delivery
                                        WHERE delivery_id=? LIMIT 1")){
        $statement->bind_param("i",$delivery_id);
        $statement->execute();
        $result = $statement->get_result();
        while($row = $result->fetch_array()){
            $result['longitude'] = $row['staff_longitude'];
            $result['latitude'] = $row['staff_latitude'];
        }
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
    $connect->close();

    echo json_encode($result,JSON_FORCE_OBJECT);
?>