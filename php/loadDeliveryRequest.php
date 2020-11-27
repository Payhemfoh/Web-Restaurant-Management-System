<?php
    $staff_username = $_POST['username'];

    if(!empty($staff_username)){
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
                                                AND o.overall_status LIKE 'delivering'
                                                AND s.username=?")){
                $statement->bind_param("i",$staff_username);
                $statement->execute();
                $result = $statement->get_result();
            if($result->num_rows>0){
                include("../webpage/deliveryStatus_staff.php");
            }
            else{
                //if staff do not accept delivery quest yet
                if($statement = $connect->prepare("SELECT d.delivery_id,c.username,d.customer_address
                                                    FROM delivery d, orders o, customer c
                                                    WHERE o.delivery_id = d.delivery_id
                                                    AND o.customer_id = c.customer_id
                                                    AND o.overall_status = 'delivering'
                                                    AND d.staff_id IS NULL")){
                    $statement->execute();
                    $result = $statement->get_result();

                    echo "<table style='width:100%'>";
                    while($row = $result->fetch_assoc()){
                        printf("<div class=\"delivery_request\"><tr><td>
                                    <h4>Customer Username :</h4><p> %s</p>
                                    <h4>Customer Location :</h4><p> %s</p>
                                <br><br></td>
                                <td>
                                    <button class='btn btn-block btn-primaryLight btn-primary btn_accepted' value='%d'>Accept</button>
                                </td>
                                </div>
                        ",$row['username'],$row['customer_address'],$row['delivery_id']);
                        }

                    $statement->close();
                }else{
                    die("Failed to prepare SQL statement.".$connect->error);
                }
            }
            
        }else{
            die("Failed to prepare SQL statement.".$connect->error);
        }
    }else{
        echo "<p>Failed to update data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
    }
?>