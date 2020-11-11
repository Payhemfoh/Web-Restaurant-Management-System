<?php
    $itemId = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    $modify = $connect->prepare("UPDATE order_item SET order_status = 'completed' WHERE item_id=?");
    $modify->bind_param("i",$itemId);
    $modify->execute();

    if($statement = $connect->prepare("SELECT * 
                                        FROM order_item
                                        WHERE item_id = ? LIMIT 1;")){
        $statement->bind_param("i",$itemId);
        $statement->execute();
        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            $orderId = $row['order_id'];
            $check = $connect->prepare("SELECT * FROM order_item WHERE order_id=?");
            $check->bind_param("i",$orderId);
            $check->execute();
            $result = $check->get_result();
            $allComplete = true;
            while($record = $result->fetch_array()){
                if($record['order_status'] === "preparing"){
                    $allComplete = false;
                }
            }
            if($allComplete){
                $update = $connect->prepare("UPDATE orders SET overall_status = 'delivering' WHERE order_id=?");
                $update->bind_param("i",$orderId);
                $update->execute();
            }
        }

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
?>