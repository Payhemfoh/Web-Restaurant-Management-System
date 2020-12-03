<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS|Completed Order History</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__));?>

        <br/>
        <div id="content" class="container bg-light col-md-6 rounded">
        <br>
            <div class="h2 text-center">Completed Order History</div>
            <br>
            <table id="history_table" class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Order</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Date Time</th>
                        <th scope="col">Service type</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        //database connection
                        $connect = new mysqli("localhost","root","","rms_database");

                        //check connection
                        if($connect->connect_error){
                            die("Connection error : $connect->connect_errno : $connect->connect_error");
                        }
                        
                        //use parameterized query to prevent sql injection
                        //insert data into stock table
                        if($statement = $connect->prepare("SELECT m.menu_name,i.quantity,o.*,c.username,i.item_id,m.menu_picture
                                                    FROM menu m,order_item i,orders o, customer c 
                                                    WHERE order_status LIKE 'completed' 
                                                    AND i.menu_id = m.menu_id
                                                    AND i.order_id = o.order_id
                                                    AND o.customer_id = c.customer_id
                                                    ORDER BY item_id desc")){
                            $statement->execute();
                            $result = $statement->get_result();
                            $lastorderId = 0;
                            while($row = $result->fetch_assoc()){
                            $lastorderId = $row['order_id'];
                            printf("<tr>
                                    <td>%s</td>
                                    <td>%s</td>
                                    <td>%d</td>
                                    <td>%s</td>
                                    <td>%s</td></tr>"
                                    ,$row['username'],
                                    $row['menu_name'],
                                    $row['quantity'],$row['date_time'],
                                    $row['order_type']);
                            }

                            $statement->close();
                        }
                    ?>
                </tbody>
            </table>    
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
    </body>
    <script>
        $(()=>{
            $("#history_table").DataTable({
                "order":[]
            });
        });
    </script>
</html>
