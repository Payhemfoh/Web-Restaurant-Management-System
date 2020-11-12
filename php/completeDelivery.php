<?php
    $deliveryId = $_POST['delivery_id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("UPDATE delivery d, orders o
                                        SET o.overall_status = 'arrived'
                                        WHERE d.delivery_id=?
                                        AND d.delivery_id = o.delivery_id")){
        $statement->bind_param("i",$delivery_id);
        $statement->execute();
        
        if($statement->get_result()){
            echo "<h4>Delivery Request Completed</h4><br>
            <button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
        }else{
            echo "<h4>Failed to complete delivery request</h4><button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
        }

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
    $connect->close();
?>