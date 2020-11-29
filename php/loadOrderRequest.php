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
                                        AND o.customer_id = c.customer_id
                                        ORDER BY order_id;")){
        $statement->execute();
        $result = $statement->get_result();
        $lastorderId = -1;
        echo "<table style='width:100%'>";
        while($row = $result->fetch_assoc()){
            if($lastorderId === -1) $lastorderId = $row['order_id'];
            printf("<div class=\"order_item\"><tr>
                        <td ".( $row['order_id']!==$lastorderId ?"style='border-bottom:2px solid gray;'":'').">
                        <h3>Order :</h3><p> %s</p>
                        <h4>Quantity :</h4><p> %d</p>
                        <h4>Date Time:</h4><p> %s</p>
                        <h4>Service type :</h4><p> %s</p>
                        <h4>Customer username :</h4><p> %s</p>",
                        $row['menu_name'],
                        $row['quantity'],$row['date_time'],
                        $row['order_type'],$row['username']);

            echo        $row['order_type']==="dine_in"?("<h4>tableNo : </h4><p>".$row['table_no']."</p>"):"";
            echo        $row['order_type']==="take_away"?("<h4>arrival time : </h4><p>".$row['arrival_time']."</p>"):"";
            printf("<br><br></td>
                    <td ".( $row['order_id']!==$lastorderId ?"style='border-bottom:2px solid gray;'":'')."><img src='%s' width='300' height='200'></td>
                    <td ".( $row['order_id']!==$lastorderId ?"style='border-bottom:2px solid gray;'":'')."><button class='btn btn-block btn-primaryLight btn-primary btn_done' value='%d'>
                    Done
                    </button></td>
                    </div></tr>
            ",$row['menu_picture'],$row['item_id']);
            $lastorderId = $row['order_id'];
        }
        echo "<hr />";
        echo "</table>";

        $statement->close();
    }else{
        die("Failed to prepare SQL statement.".$connect->error);
    }

    $connect->close();
?>