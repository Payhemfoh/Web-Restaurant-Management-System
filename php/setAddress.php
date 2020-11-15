<?php
    if(!isset($_SESSION))
        session_start();
    //get location
    $username =$_SESSION['sess_username'];
    $order_id = $_COOKIE['orderId'];
    $location_address = $_POST['location_address'];
    $valid = true;

    //validate
    if(empty($username)){
        echo "Username is empty!<br>";
        $valid = false;
    }

    if(empty($order_id)){
        echo "Order Id is empty!<br>";
        $valid = false;
    }

    if(empty($location_address)){
        echo "Location address is empty!<br>";
        $valid = false;
    }
    
    if($valid){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        if($statement = $connect->prepare("INSERT INTO delivery(delivery_id,customer_address) VALUES (0,?);")){
            $statement->bind_param("s",$location_address);
            $statement->execute();

            $delivery_id = $connect->insert_id;
            setcookie("delivery_id",$delivery_id,time()+ (10 * 365 * 24 * 60 * 60),"/");

            if($update = $connect->prepare("UPDATE orders SET delivery_id = ? WHERE order_id=?")){
                $update->bind_param("ii",$delivery_id,$order_id);
                $update->execute();
                $update->close();
            }

            $file = $username.'_'.$delivery_id.'.txt';

            if($setFile = $connect->prepare("UPDATE delivery SET chatFile = ? WHERE delivery_id=?")){
                $setFile->bind_param("si",$file,$delivery_id);
                $setFile->execute();
                $setFile->close();
            }
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.");
        }
        $connect->close();
    }
    
?>