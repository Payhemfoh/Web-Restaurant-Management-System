<?php
    $deliveryId = $_POST['delivery_id'];

    if(!empty($deliveryId)){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        //get orderId
        if($check = $connect->prepare("SELECT order_id,delivery_id FROM orders WHERE delivery_id = ? LIMIT 1")){
            $check->bind_param("i",$deliveryId);
            $check->execute();
            $result = $check->get_result();
            if($row = $result->fetch_assoc()){
                $orderId = $row['order_id'];

                if($statement = $connect->prepare("UPDATE orders
                                                SET overall_status = 'arrived'
                                                WHERE order_id=?")){
                    $statement->bind_param("i",$orderId);
                    $statement->execute();

                    setcookie("delivery_id","",time()-3600,"/");
                    
                    echo "<h4>Delivery Request Completed</h4><br>
                    <button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";

                    $statement->close();
                }else{
                    die("Failed to prepare SQL statement.".$connect->error);
                }
            }
            $check->close();
        }else{
            die("Failed to prepare SQL statement.".$connect->error);
        }

        
        $connect->close();
    }else{
        echo "<p>Failed to update data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
    }
?>