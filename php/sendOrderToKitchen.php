<?php
    $username = $_POST['username'];
    $orderId = 0;
    $orderList = json_decode($_COOKIE['orderList']);
    $service = $_COOKIE['service'];

    if(isset($_COOKIE['orderId']))
        $orderId = $_COOKIE['orderId'];
    
    //validation
    if(empty($username)){
        echo "Username is empty!<br>";
        $valid = false;
    }

    if(empty($orderList)){
        echo "Order List is empty!<br>";
        $valid = false;
    }

    if(empty($service)){
        echo "Service is empty!<br>";
        $valid = false;
    }

    if($valid){
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
            if($newOrder = $connect->prepare("INSERT INTO orders(order_id,customer_id,date_time,order_type,overall_status)
                                            VALUES (0,?,SYSDATE(),?,'order received')")){
                $newOrder->bind_param("is",$customer_id,$service);
                $newOrder->execute();
                $orderId = $newOrder->insert_id;

                setcookie("orderId",$orderId,time()+ (10 * 365 * 24 * 60 * 60),"/");

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
            }else{
                echo "Failed to create new order".$connect->error;
            }
        }

        if($orderId != 0){
            //create order item one-by-one
            if($insert = $connect->prepare("INSERT INTO order_item(item_id,menu_id,order_status,quantity,order_id)
                                        VALUES (0,?,'preparing',?,?);")){
                $id = 0;
                $qty = 0;
                $insert->bind_param("iii",$id,$qty,$orderId);

                foreach($orderList->item as $item){
                    $id = $item->id;
                    $qty = $item->qty;
                    $insert->execute();
                }
                $insert->close();
            }else{
                echo "Failed to insert record into table";
            }
            //clear the order item list
            setcookie("orderList","",time()-3600,"/");
        }

        $connect->close();
    }
?> 