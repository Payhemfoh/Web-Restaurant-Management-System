<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Order History</title>
        <?php
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__));?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <br><h3 class="text-center">Your Order History</h3><br>
            <hr>

            <?php

            //database connection
            $connect = new mysqli("localhost","root","","rms_database");

            //check connection
            if($connect->connect_error){
                die("Connection error : $connect->connect_errno : $connect->connect_error");
            }

            $sql = "SELECT * 
                    FROM orders o,customer c, payment p
                    WHERE o.customer_id = c.customer_id 
                    AND c.username LIKE '$sess_username'
                    AND o.payment_id = p.payment_id";
            $result = $connect->query($sql);

            echo '<table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Date & Time</th>
                            <th scope="col">Order Type</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Order Details</th>
                        </tr>
                    </thead><tbody>';

            if($result){
                while($row = $result->fetch_assoc())
                {
                    printf('<tr>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%.2f</td>
                                <td>%s</td>
                                <td>',$row['date_time'],$row['order_type'],$row['total_price'],$row['overall_status']);
                    $itemQuery = "SELECT * 
                            FROM order_item o,menu m
                            WHERE o.menu_id = m.menu_id
                            AND o.order_id = ".$row['order_id'];
                    $itemResult = $connect->query($itemQuery);
                    while($itemRow = $itemResult->fetch_assoc()){
                        printf("<p>%s - %d pic</p>",$itemRow['menu_name'],$itemRow['quantity']);
                    }
                    echo "</td></tr>";
                }
                echo '</tbody></table>';
            }else{
                echo $connect->error;
            }
            ?>
    </body>
</html>
