<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Kitchen Module</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
            
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <br><h2 class="text-center">Pick Up Module</h2><br><br>
            <br/>
            <div id="order_requests">

            <?php
            //database connection
            $connect = new mysqli("localhost","root","","rms_database");

            //check connection
            if($connect->connect_error){
                die("Connection error : $connect->connect_errno : $connect->connect_error");
            }

            $sql = "SELECT o.order_id, o.arrival_time, o.date_time, c.username, c.phone_number
                    FROM orders o, customer c
                    WHERE o.order_type='take_away'
                    AND o.pickup_time is null
                    AND o.customer_id = c.customer_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) 
            {
                echo '<table class="table table-hover" style="width:100%">';

                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    printf( '<tr><td>
                            <h4>Username :</h4><p> %s</p>
                            <h4>Contact No :</h4><p> %s</p>
                            <h4>Order date and time:</h4><p> %s</p>
                            <h4>Expected Arrival time:</h4><p> %s</p></td>
                            <td><button class=\'btn btn-block btn-primaryLight btn-primary btn_delivered\' value=\'%d\'>
                        Pick Up
                        </button></td>
                        </tr>',
                        $row["username"],
                        $row['phone_number'],
                        $row["date_time"],
                        $row["arrival_time"],
                        $row["order_id"]);
                }
                echo "</table>";
            }
            ?>
            </div>
            <a href='../webpage/pickupHistory.php' class='btn btn-primary btn-primaryLight btn-block'>Pick Up History</a><br>
        </div>
        
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script src="../javascript/pickUp_script.js"></script>
    </body>
</html>
