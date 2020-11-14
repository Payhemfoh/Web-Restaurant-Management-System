<?php
    $orderId = $_POST['orderId'];

    if(!empty($orderId)){
        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        if($statement = $connect->prepare("SELECT o.order_id,m.menu_name,i.quantity,m.menu_price
                                            FROM orders o, order_item i, menu m
                                            WHERE o.order_id = ?
                                            AND i.order_id = o.order_id
                                            AND i.menu_id = m.menu_id")){
            $statement->bind_param("i",$orderId);
            $statement->execute();
            $result = $statement->get_result();
            $total = 0.0;
            while($row = $result->fetch_array()){
                $totalPrice = (float)((int)$row['quantity'] * (float)$row['menu_price']);
                $total+=$totalPrice;
                printf("<tr>
                            <td>%s</td>
                            <td>%d</td>
                            <td>RM%.2f</td>
                            <td>RM%.2f</td>
                        </tr>",
                        $row['menu_name'],
                        $row['quantity'],
                        $row['menu_price'],
                        $totalPrice);
            }
            printf("<input id='totalPrice' type='hidden' value='%.2f' />",$total);
            
            $statement->close();
        }else{
            die("Failed to prepare SQL statement.".$connect->error);
        }
        $connect->close();
    }else{
        echo "<p>Failed to update data! Click the button below to try again.</p><br>";
        echo "<button id=\"btnAgain\" class=\"btn btn-block btn-lg btn-outline-primary\">Refresh</button>";
    }
?>