<?php
    $username = $_POST['username'];
    $deliveryId = $_POST['deliveryId'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($getStaffId = $connect->prepare("SELECT * FROM staff WHERE username=? LIMIT 1")){
        $getStaffId->bind_param("i",$itemId);
        $getStaffId->execute();
        $result = $getStaffId->get_result();
        if($row = $result->fetch_array()){
            $staffId = $row['staff_id'];
            if($statement = $connect->prepare("UPDATE delivery d,order o 
                                            SET d.staff_id=? 
                                            WHERE d.delivery_id=? 
                                            AND o.status LIKE 'delivering'")){
                $statement->bind_param("ii",$staffId,$deliveryId);
                $statement->execute();
                if($statement->get_result()){
                    echo "<h4>Delivery Request Accepted</h4><br>
                    <button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
                }else{
                    echo "<h4>Failed to accept delivery request</h4><button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
                }
                $statement->close();
            }else{
                die("Failed to prepare SQL statement.<br><button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>");
            }
        }
        $getStaffId->close();
    }else{
        die("Failed to prepare SQL statement.<br><button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>");
    }
?>