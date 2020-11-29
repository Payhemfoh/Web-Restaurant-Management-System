<?php
    //get id from webpage
    $id = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");
    
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT o.*,c.username,c.phone_number,p.date_time as payment_time,p.total_price
                                        FROM orders o, customer c, payment p 
                                        WHERE o.order_id=? 
                                        AND o.customer_id = c.customer_id
                                        AND o.payment_id = p.payment_id
                                        LIMIT 1")){
        $statement->bind_param("i",$id);
        $statement->execute();

        $result = $statement->get_result();

        while($row = $result->fetch_assoc()){
            printf("
                    <h3 class='text-center'>Payment Record</h3><br>
                    <h4>Username : </h4><p>%s</p>
                    <h4>Contact No : </h4><p>%s</p>
                    <h4>Order time : </h4><p>%s</p>
                    <h4>Order details : </h4>",
                    $row['username'],$row['phone_number'],$row['date_time']);

            if($item_result = $connect->query("SELECT * 
                                            FROM orders o, order_item i, menu m 
                                            WHERE o.order_id = ".$row['order_id'].
                                            " AND o.order_id = i.order_id 
                                            AND i.menu_id = m.menu_id")){
            
                while($item_row = $item_result->fetch_assoc()){
                    printf("<p>%s - %d pic</p>",$item_row['menu_name'],$item_row['quantity']);
                }
            }else{
                die("Failed to prepare SQL statement.".$connect->error);
            }
                    
            printf("<h4>Service Type : </h4><p>%s</p>
                    <h4>Total Price : </h4><p>%s</p>
                    <h4>Payment Time : </h4><p>%s</p>
                    <button id='modal-cancel' class='btn btn-block btn-primaryLight btn-primary'>Return to History Page</button>			
                </form>
            ",$row['order_type'],$row['total_price'],$row['payment_time']);
        }
    }else{
        die("Failed to prepare SQL statement.");
    }

    $statement->close();
    $connect->close();
?>