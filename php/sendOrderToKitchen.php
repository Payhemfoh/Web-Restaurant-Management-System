<?php
    $username = $_POST['username'];
    $orderId = 0;
    $orderList = json_decode($_COOKIE['orderList']);
    $service = $_COOKIE['service'];

    if(isset($_COOKIE['orderId']))
        $orderId = $_COOKIE['orderId'];
    

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    //get customer_id from the username
    if($search = $connect->prepare("SELECT customer_id FROM customer WHERE username = ? LIMIT 1")){
        $search->bind_param("s",$username);
        $search->execute();
        $result = $search->get_result();
        if($row = $result->fetch_array()){
            $customer_id = $row['customer_id'];
        }
    }else{
        die("Failed to search the customer id");
    }

    //create new order if no orderId found
    if($orderId === 0){
        $newOrder = $connect->prepare("INSERT INTO orders(order_id,customer_id,data_time,order_type,overall_status)
                                        VALUES (0,?,SYSDATE(),?,'order received')");
        $newOrder->bind_param("is",$customer_id,$service);
        $newOrder->execute();
        $orderId = $newOrder->insert_id;

        setcookie("orderId",$orderId);

        if($service === "dine_in"){
            $table_no = $_COOKIE['table_no'];
            $modify = $connect->prepare("UPDATE orders SET table_no=? WHERE order_id=?;");
            $modify->bind_param("ii",$table_no,$orderId);
            $modify->execute();
            $modify->close();
        }else if($service === "take_away"){
            $datetime = $_COOKIE['arrival'];
            $arrival = date("Y-m-d H:i:s",strtotime($datetime));
            $modify = $connect->prepare("UPDATE orders SET arrival_time=? WHERE order_id=?;");
            $modify->bind_param("si",$arrival,$orderId);
            $modify->execute();
            $modify->close();
        }

        $newOrder->close();
    }

    //create order item one-by-one
    $insert = $connect->prepare("INSERT INTO order_item(item_id,menu_id,order_status,quantity,order_id)
                                VALUES (0,?,'preparing',?,?);");
    $insert->bind_param("isii",$item->id,$item->qty,$orderId);

    foreach($orderList->item as $item){
        $insert->execute();
    }
    $insert->close();
    //clear the order item list
    setcookie("orderList","",time()-3600);

    $connect->close();
?> 