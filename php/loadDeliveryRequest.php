<?php
    $staff_username = $_POST['username'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }
    
    //check if staff already accept delivery quest
    if($statement = $connect->prepare("SELECT * 
                                            FROM delivery d, orders o,staff s
                                            WHERE o.delivery_id = d.delivery_id 
                                            AND d.staff_id = s.staff_id
                                            AND o.status LIKE 'delivering'
                                            AND s.username=?")){
            $statement->bind_param("i",$staff_username);
            $statement->execute();
            $result = $statement->get_result();
        if($result->num_rows>0){
            include("../webpage/deliveryStatus_staff.php");
        }
        else{
            //if staff do not accept delivery quest yet
            if($statement = $connect->prepare("SELECT * 
                                                FROM delivery d, orders o, customer c,
                                                WHERE o.delivery_id = d.delivery_id 
                                                AND o.status LIKE 'delivering'
                                                AND d.staff_id IS NULL")){
                $statement->execute();
                $result = $statement->get_result();

                while($row = $result->fetch_array()){
                    printf("<div class=\"delivery_request\"
                                <h3>Customer Username : %s</h3>
                                <h3>Customer Location : %s</h3>
                                <button class='btn btn-block btn-primaryLight btn-primary btn_done' value='%d'>Accept</button>
                            </div>
                    ",$row['username'],$row['address']);
                    }

                $statement->close();
            }else{
                die("Failed to prepare SQL statement.");
            }
        }
    }   
?>