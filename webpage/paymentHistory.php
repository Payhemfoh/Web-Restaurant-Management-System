<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS|Payment History</title>
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
            <div class="h2 text-center">Payment History</div>
            <br>
            <table id="table" class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Contact No</th>
                        <th>Order date and time</th>
                        <th>Service Type</th>
                        <th>Total Price</th>
                        <th>Payment Time</th>
                        <th>Details</th>
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
                        if($statement = $connect->prepare("SELECT c.username,c.phone_number, o.*, p.date_time as payment_time, p.total_price
                                                            FROM orders o, customer c, payment p
                                                            WHERE o.order_type='take_away'
                                                            AND c.username LIKE '?'
                                                            AND o.customer_id = c.customer_id
                                                            AND p.payment_id = o.payment_id
                                                            ORDER BY o.pickup_time;")){
                            $statement->execute($sess_username);
                            $result = $statement->get_result();
                            while($row = $result->fetch_assoc()){
                            printf( '<tr>
                                        <td> %s</td>
                                        <td> %s</td>
                                        <td> %s</td>
                                        <td> %s</td>
                                        <td> %s</td>
                                        <td> %s</td>
                                        <td><button class=\'btn btn-block btn-primaryLight btn-primary btn_detail\' value=\'%d\'>Details</button></td>
                                    </tr>',
                                    $row["username"],
                                    $row['phone_number'],
                                    $row["date_time"],
                                    $row['order_type'],
                                    $row['total_price'],
                                    $row['payment_time'],
                                    $row['order_id']);
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
        <script>
            $(".btn_detail").on("click",function(){
                let id = this.getAttribute("value");

                $.ajax("../php/showPaymentDetail.php",{
                    method:"POST",
                    dataType:"HTML",
                    data:{id:id},
                    success:(data) => {
                        $("#modal-title").text("Pick Up Detail");
                        $(".modal-body").html(data);
                        $(".modal-footer").html("");
                        $("#modal-cancel").attr("data-dismiss","modal");
                        $("#modal").modal();
                    }
                }); // end callback
            });//end on set listener
        </script>
    </body>
</html>
