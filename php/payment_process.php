<?php
    $totalPrice = $_POST['totalPrice'];
    $orderId = $_COOKIE['orderId'];
    $service = $_COOKIE['service'];
    $payment_method = $_POST['payment_method'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($payment_method === "cash"){
        if($statement = $connect->prepare("INSERT INTO payment(payment_id,total_price)
                                            VALUES (0,?)")){
            $statement->bind_param("d",$totalPrice);
            $statement->execute();
            $paymentId = $statement->insert_id;

            if($service === "dine_in"){
                if($update = $connect->prepare("UPDATE orders SET payment_id=?,overall_status='arrived' WHERE order_id = ?")){
                    $update->bind_param("ii",$paymentId,$orderId);
                    $update->execute();
                    $update->close();
                }else{
                    die("Failed to update order.".$connect->error);
                }
            }else{
                if($update = $connect->prepare("UPDATE orders SET payment_id=? WHERE order_id = ?")){
                    $update->bind_param("ii",$paymentId,$orderId);
                    $update->execute();
                    $update->close();
                }else{
                    die("Failed to update order.".$connect->error);
                }
            }

            if($service === "dine_in" || $service==="take_away"){
                setcookie("orderList","",time()-3600,"/");
                setcookie("orderId","",time()-3600,"/");
                setcookie("service","",time()-3600,"/");
                setcookie("tableNo","",time()-3600,"/");
                setcookie("arrival","",time()-3600,"/");
                echo "<p>Please pay at the counter.</p><br>";
                echo "<button id=\"complete\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Homepage</button>";
            }else{
                echo "<p>Click the button below to enter delivery address</p><br>";
                echo "<button id=\"complete\" class=\"btn btn-block btn-lg btn-outline-primary\">Enter Delivery Address</button>";
            }
            
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.".$connect->error);
        }
    }else{
        if($statement = $connect->prepare("INSERT INTO payment(payment_id,date_time,total_price)
                                            VALUES (0,now(),?)")){
            $statement->bind_param("d",$totalPrice);
            $statement->execute();
            $paymentId = $statement->insert_id;

            if($service === "dine_in"){
                if($update = $connect->prepare("UPDATE orders SET payment_id=?,overall_status='arrived' WHERE order_id = ?")){
                    $update->bind_param("ii",$paymentId,$orderId);
                    $update->execute();
                    $update->close();
                }else{
                    die("Failed to update order.".$connect->error);
                }
            }else{
                if($update = $connect->prepare("UPDATE orders SET payment_id=? WHERE order_id = ?")){
                    $update->bind_param("ii",$paymentId,$orderId);
                    $update->execute();
                    $update->close();
                }else{
                    die("Failed to update order.".$connect->error);
                }
            }

            if($service === "dine_in" || $service==="take_away"){
                setcookie("orderList","",time()-3600,"/");
                setcookie("orderId","",time()-3600,"/");
                setcookie("service","",time()-3600,"/");
                setcookie("tableNo","",time()-3600,"/");
                setcookie("arrival","",time()-3600,"/");
                echo "<p>Payment Process Successfully. Please come again.</p><br>";
                echo "<button id=\"complete\" class=\"btn btn-block btn-lg btn-outline-primary\">Return to Homepage</button>";
            }else{
                echo "<p>Payment Process Successfully. Click the button below to enter delivery address</p><br>";
                echo "<button id=\"complete\" class=\"btn btn-block btn-lg btn-outline-primary\">Enter Delivery Address</button>";
            }
            
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.".$connect->error);
        }
    }
    $connect->close();
?>