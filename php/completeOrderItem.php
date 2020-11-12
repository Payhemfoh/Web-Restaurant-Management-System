<?php
    $itemId = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    $modify = $connect->prepare("UPDATE order_item i, orders o 
                                SET i.order_status = 'completed',o.overall_status='preparing' 
                                WHERE item_id=?");
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

                if($statement->get_result()){
                    echo "<h4>Order Item Completed</h4><br>
                    <button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
                }else{
                    echo "<h4>Failed to complete order item</h4><button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
                }
                $update->close();
            }

            $check->close();
        }

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
?>