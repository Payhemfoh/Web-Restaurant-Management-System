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
                if($statement = $connect->prepare("UPDATE delivery d,orders o
                                                SET d.staff_id=?, o.overall_status = 'delivering' 
                                                WHERE o.delivery_id=?")){
                    $statement->bind_param("ii",$staffId,$deliveryId);
                    $statement->execute();
                    
                    setcookie("delivery_id",$deliveryId,time()+ (10 * 365 * 24 * 60 * 60),"/");
                    echo "<h4>Delivery Request Accepted</h4><br>
                    <button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
                    
                    $statement->close();
                }else{
                    die("Failed to prepare SQL statement.".$connect->error);
                }

                if($statement = $connect->prepare("UPDATE orders 
                                                SET pickup_time=NOW() 
                                                WHERE delivery_id=?")){
                    $statement->bind_param("i",$deliveryId);
                    $statement->execute();
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