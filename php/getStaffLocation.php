<?php
    $delivery_id = $_POST['id'];
    $data = array();

    if(!empty($delivery_id)){
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
            while($row = $result->fetch_assoc()){
                $data['longitude'] = $row['staff_longitude'];
                $data['latitude'] = $row['staff_latitude'];
            }
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }

    echo json_encode($data,JSON_FORCE_OBJECT);
?>