<?php
    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT m.menu_name,i.quantity,o.*,c.username,i.item_id,m.menu_picture
                                        FROM menu m,order_item i,orders o, customer c 
                                        WHERE order_status LIKE 'preparing' 
                                        AND i.menu_id = m.menu_id
                                        AND i.order_id = o.order_id
                                        AND o.customer_id = c.customer_id;")){
        $statement->execute();
        $result = $statement->get_result();

        echo "<table style='width:100%'>";
        while($row = $result->fetch_assoc()){
            printf("<div class=\"order_item\"><tr><td>
                        <h3>Order : %s</h3>
                        <h4>Quantity : %d</h4>
                        <h4>Date Time: %s</h4>
                        <h4>Service type : %s</h4>
                        <h4>Customer username : %s</h4>",
                        $row['menu_name'],
                        $row['quantity'],$row['date_time'],
                        $row['order_type'],$row['username']);

            echo        $row['order_type']==="dine_in"?"tableNo : ".$row['table_no']:"";
            echo        $row['order_type']==="take_away"?"arrival time : ".$row['arrival_time']:"";
            printf("<br><br></td>
                    <td><img src='%s' width='300' height='200'></td>
                    <td><button class='btn btn-block btn-primaryLight btn-primary btn_done' value='%d'>
                    Done
                    </button></td>
                    </div></tr>
            ",$row['menu_picture'],$row['item_id']);
        }
        echo "</table>";

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.".$connect->error);
    }

    $connect->close();
?>