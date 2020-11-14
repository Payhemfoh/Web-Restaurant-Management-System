<?php
    $orderId = $_POST['orderId'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("UPDATE orders
                                        SET overall_status = 'arrived'
                                        WHERE order_id = ?")){
        $statement->bind_param("i",$orderId);
        $statement->execute();
        
        echo "<h4>Pick Up Request Completed</h4><br>
        <button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
    $connect->close();
?>