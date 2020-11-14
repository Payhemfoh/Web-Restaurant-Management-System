<?php
    $username = $_POST['username'];
    $deliveryId = $_POST['deliveryId'];
    $valid = true;

    if(empty($username)){
        echo "username is empty!<br>";
        $valid = false;
    }

    if(empty($deliveryId)){
        echo "deliveryId is empty!<br>";
        $valid = false;
    }

    if($valid){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        
        if($getStaffId = $connect->prepare("SELECT * FROM staff WHERE username=? LIMIT 1")){
            $getStaffId->bind_param("s",$username);
            $getStaffId->execute();
            $result = $getStaffId->get_result();
            if($row = $result->fetch_array()){
                $staffId = $row['staff_id'];
                if($statement = $connect->prepare("UPDATE delivery 
                                                SET staff_id=? 
                                                WHERE delivery_id=?")){
                    $statement->bind_param("ii",$staffId,$deliveryId);
                    $statement->execute();
                    
                    echo "<h4>Delivery Request Accepted</h4><br>
                    <button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
                    
                    $statement->close();
                }else{
                    die("Failed to prepare SQL statement.".$connect->error);
                }
            }
            $getStaffId->close();
        }else{
            die("Failed to prepare SQL statement.".$connect->error);
        }
    }
?>