<?php
    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * 
                                        FROM menu m,order_item i,orders o, customer c 
                                        WHERE order_status LIKE 'preparing' 
                                        AND i.menu_id = m.menu_id
                                        AND i.order_id = o.order_id
                                        AND o.customer_id = c.customer_id;")){
        $statement->execute();
        $result = $statement->get_result();

        while($row = $result->fetch_array()){
            printf("<div class=\"order_item\"
                        <h3>Order : %s</h3>
                        <h4>Quantity : %d</h4>
                        <h4>Service type : %s</h4>
                        <h4>Customer username : %s</h4>".
                        $row['order_type']==="dine_in"?"tableNo : ".$row['table_no']:"".
                        $row['order_type']==="take_away"?"arrival time : ".$row['arrival_time']:"".
                        "<button class='btn btn-block btn-primaryLight btn-primary btn_done' value='%d'>Done</button>
                    </div>
            ",$row['menu_name'],$row['quantity'],$row['date_time'],$row['order_type'],$row['username'],$row['item_id']);
        }

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
?>