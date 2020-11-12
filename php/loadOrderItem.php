<?php
    $deliveryId = $_POST['deliveryId'];

    //database connection
    $connect = new mysqli("localhost","root","","rms_database");

    //check connection
    if($connect->connect_error){
        die("Connection error : $connect->connect_errno : $connect->connect_error");
    }

    if($statement = $connect->prepare("SELECT * 
                                        FROM delivery d, orders o, order_item i, menu m
                                        WHERE d.delivery_id=?
                                        AND d.delivery_id = o.delivery_id
                                        AND i.order_id = o.order_id
                                        AND i.menu_id = m.menu_id")){
        $statement->bind_param("i",$deliveryId);
        $statement->execute();
        $result = $statement->get_result();
        while($row = $result->fetch_array()){
            printf("<tr>
                        <td>%s</td>
                        <td>%d</td>
                        <td>RM%.2f</td>
                        <td>RM%.2f</td>
                    </tr>",
                    $row['menu_name'],
                    $row['quantity'],
                    $row['menu_price'],
                    (float)((int)$row['quantity'] * (float)$row['menu_price']));
        }
        
        $statement->close();
    }else{
        die("Failed to prepare SQL statement.");
    }
    $connect->close();
?>