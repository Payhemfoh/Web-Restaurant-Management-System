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

            $sql = "SELECT customer_id FROM orders";
            $result = $connect->query($sql);

            echo '<table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Date & Time</th>
                            <th scope="col">Order Type</th>
                        </tr>';

                    if($result == "customer_id")
                    {
                        while ($result == "customer_id")
                        {
                            echo '<td>\"date_time"\</td>
                            <td>\"order_type"\</td>
                            </thread>
                            </table>';
                        }
                    }
            ?>
    </body>
</html>
