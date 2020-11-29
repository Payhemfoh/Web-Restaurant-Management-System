<?php
    $orderId = $_POST['orderId'];

    if(!empty($orderId)){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        $userresult = $connect->query("SELECT payment_id FROM orders WHERE order_id = $orderId");
        while($userrow = $userresult->fetch_assoc()){
            $paymentId = $userrow['payment_id'];
            if($statement = $connect->prepare("UPDATE payment
                                                SET date_time = now()
                                                WHERE payment_id = ?")){
                $statement->bind_param("i",$paymentId);
                $statement->execute();
                
                echo "<h4>Payment Completed</h4><br>
                <button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";

                $statement->close();
            }else{
                die("Failed to prepare SQL statement.".$connect->error);
            }
        }
        $connect->close();
    }else{
        echo "<p>Failed to update data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
    }
?>