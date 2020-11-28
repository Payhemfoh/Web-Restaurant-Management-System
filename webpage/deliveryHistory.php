<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS|Completed Pick Up History</title>
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
            <div class="h2 text-center">Completed Pick Up History</div>
            <br>
            <table id="table" class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Contact No</th>
                        <th scope="col">Pick Up Time</th>
                        <th scope="col">Delivery Staff</th>
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
                        if($statement = $connect->prepare("SELECT o.*, c.username as cusername, c.phone_number, s.username as susername
                                                            FROM orders o, customer c, delivery d, staff s
                                                            WHERE o.order_type LIKE 'delivery'
                                                            AND o.overall_status LIKE 'arrived'
                                                            AND o.customer_id = c.customer_id
                                                            AND o.delivery_id = d.delivery_id
                                                            AND d.staff_id = s.staff_id
                                                            ORDER BY o.pickup_time;")){
                            $statement->execute();
                            $result = $statement->get_result();
                            while($row = $result->fetch_assoc()){
                            printf( '<tr>
                                        <td> %s</td>
                                        <td> %s</td>
                                        <td> %s</td>
                                        <td> %s</td>
                                        <td><button class=\'btn btn-block btn-primaryLight btn-primary btn_detail\' value=\'%d\'>Details</button></td>
                                    </tr>',
                                    $row["cusername"],
                                    $row['phone_number'],
                                    $row['pickup_time'],
                                    $row['susername'],
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

                $.ajax("../php/showDeliveryDetail.php",{
                    method:"POST",
                    dataType:"HTML",
                    data:{id:id},
                    success:(data) => {
                        $("#modal-title").text("Delivery Detail");
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
