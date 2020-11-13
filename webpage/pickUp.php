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

            $sql = "SELECT order_id, order_type, overall_status FROM orders";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) 
            {
                printf( '<tr>
                    <td>%s</td>
                    <td>%s</d>
                    <td>%s</d>
                </tr>',
                "Order type",
                "Overall status",
                "Done");

                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    $checkType = $row["order_type"];
                    $checkStatus = $row["overall_status"];
                    $id = $row["order_id"];
                
                    if( $checkType == "take_away" && $checkStatus == "delivering" ){
                        printf( '<tr>
                                <td>%s</td>
                                <td>%s</d>
                                <td>%s</d>
                            </tr>',
                            $row["order_type"],
                            $row['overall_status'],
                            "<input type='checkbox' onclick='checkTick(this,$id);'/>");
                    }
                }
            }
        ?>
        </div>
        
        <script type="text/javascript">
            function checkTick(tick,currentId)
            {
                if(tick.checked() == true)
                {
                    var mysql = require('mysql');

                    var link = mysql.createConnection({
                    host: "localhost",
                    user: "root",
                    password: "",
                    database: "rms_database"
                    });

                    link.connect(function(e) {
                        if (e) throw e;
                        var sql = "UPDATE orders SET overall_status ='arrived' WHERE id = currentId";
                        link.query(sql, function (e, result) {
                            if (e) throw e;
                                console.log(result.affectedRows + " record(s) updated");
                        });
                    });
                }
            }
        </script>
        
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/kitchenModule_script.js" ></script>
    </body>
</html>