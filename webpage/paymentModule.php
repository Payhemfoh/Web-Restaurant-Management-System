<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Payment Module</title>
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
            <br><h2 class="text-center">Payment Module</h2><br><br>
            <br/>
            <div id="order_requests">

            <?php
            //database connection
            $connect = new mysqli("localhost","root","","rms_database");

            //check connection
            if($connect->connect_error){
                die("Connection error : $connect->connect_errno : $connect->connect_error");
            }

            $sql = "SELECT o.order_id, o.date_time, o.order_type ,c.username, c.phone_number, p.total_price
                    FROM orders o, customer c, payment p
                    WHERE p.date_time is null
                    AND o.payment_id = p.payment_id
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
                            <h4>Service Type:</h4><p> %s</p>
                            <h4>Total Price:</h4><p> %.2f</p></td>
                            <td><button class=\'btn btn-block btn-primaryLight btn-primary btn_paid\' value=\'%d\'>
                        Pick Up
                        </button></td>
                        </tr>',
                        $row["username"],
                        $row['phone_number'],
                        $row["date_time"],
                        $row["order_type"],
                        $row['total_price'],
                        $row["order_id"]);
                }
                echo "</table>";
            }
            ?>
            </div>
            <a href='../webpage/paymentHistory.php' class='btn btn-primary btn-primaryLight btn-block'>Payment Record</a><br>
        </div>
        
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script>
            $(()=>{
                $(".btn_paid").on("click",(e)=>{
                    e.preventDefault();
                    let orderId = e.target.getAttribute("value");

                    $.ajax({
                        url:"../php/completePayment.php",
                        method:"post",
                        data:{orderId:orderId},
                        success:(data)=>{
                            $("#modal-title").text("Order Done");
                            $(".modal-body").html(data);
                            $(".modal-footer").html("");
                            $("#btnAgain").attr("data-dismiss","modal");
                            $("#btnAgain").on("click",()=>location.reload());
                            $("#modal").modal();
                            setTimeout(()=>$("#btnAgain").trigger("click"),1000);
                        },
                    });
                });
            });
        </script>
    </body>
</html>
