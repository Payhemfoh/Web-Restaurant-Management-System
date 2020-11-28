<?php
    //get id from webpage
    $id = $_POST['id'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");
    
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT o.*, c.username as cusername, c.phone_number, d.customer_address, s.username as susername
                                        FROM orders o, customer c, delivery d, staff s
                                        WHERE o.order_id = ? 
                                        AND o.customer_id = c.customer_id
                                        AND o.delivery_id = d.delivery_id
                                        AND d.staff_id = s.staff_id
                                        LIMIT 1;")){
        $statement->bind_param("i",$id);
        $statement->execute();

        $result = $statement->get_result();

        while($row = $result->fetch_assoc()){
            printf("
                    <h3 class='text-center'>Pick Up Record</h3><br>
                    <h4>Username : </h4><p>%s</p>
                    <h4>Contact No : </h4><p>%s</p>
                    <h4>Customer Location :</h4><p>%s</p>
                    <h4>Order time : </h4><p>%s</p>
                    <h4>Order details : </h4>",
                    $row['cusername'],$row['phone_number'],$row['customer_address'],$row['date_time']);

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
                    
            printf("<h4>Delivery Staff :</h4><p>%s</p>
                    <h4>Staff Pick Up Time : </h4><p>%s</p>
                    <button id='modal-cancel' class='btn btn-block btn-primaryLight btn-primary'>Return to History Page</button>			
                </form>
            ",$row['susername'],$row['pickup_time']);
        }
    }else{
        die("Failed to prepare SQL statement.");
    }

    $statement->close();
    $connect->close();
?>