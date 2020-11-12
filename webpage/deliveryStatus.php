<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Delivery Status</title>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD1DxO02YcvRjKIgmOQoNoU1neglwQr0w&v=weekly"
      defer></script>
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
            <br>

            <div class="alert">
                <br><h3 class="text-center">Your orders:</h3></br>
                <table id="order_table" class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>

                    <tbody id='order_item_list'>
                        
                    </tbody>
                </table>
            </div>
            <br><hr>

            <div id="status" class="alert">
                <br><h3 class="text-center">Your food status</h3><br>
                <div class="progress" style="height: 20px">
                    <div id='progress_bar' class="progress-bar progress-bar-striped progress-bar-animated" 
                    role="progress-bar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="4">
                    0%
                    </div>
                </div>
                <br>
                <ul class="pagination pagination-lg justify-content-center">
                    <li id='waiting' class="page-item flex-fill noaction"><span class="page-link text-center">Waiting</span></li>
                    <li id='preparing' class="page-item flex-fill noaction"><span class="page-link text-center">Preparing</span></li>
                    <li id='delivering' class="page-item flex-fill noaction"><span class="page-link text-center">Delivering</span></li>
                    <li id='arrived' class="page-item flex-fill noaction"><span class="page-link text-center">Arrived</span></li>
                </ul>
            </div>
            <br>

            <div id="gps" class="alert alert-info">
                <p class="h1 text-center">Your Location</p>
                <p id="location" class="text-center">
                <?php 
                    $id = $_COOKIE['delivery_id'];
                    //database connection
                    $connect = new mysqli("localhost","root","","rms_database");

                    //check connection
                    if($connect->connect_error){
                        die("Connection error : $connect->connect_errno : $connect->connect_error");
                    }

                    if($statement = $connect->prepare("SELECT staff_latitude,staff_longitude FROM delivery WHERE delivery_id=? LIMIT 1;")){
                        $statement->bind_param("s",$id);
                        $statement->execute();
                        $delivery_result = $statement->get_result();
                        while($row = $delivery_result->fetch_array()){
                            echo $row['customer_address'];
                            echo "<input type='hidden' id='staff_latitude' value='".($row['staff_latitude']===null?"0":$row['staff_latitude'])."'>";
                            echo "<input type='hidden' id='staff_longitude' value='".($row['staff_longitude']===null?"0":$row['staff_longitude'])."'>";
                            echo "<input type='hidden' id='delivery_id' value='$id'> ";
                            echo "<input type='hidden' id='orderId' value='".$_COOKIE['orderId']."'> ";
                        }
                        $statement->close();
                    }else{
                        die("Failed to prepare SQL statement.");
                    }
                    $connect->close();

                ?></p>
                <div id="map" style="height:500px;"></div>
            </div>

            <div id="chatbox" class="alert alert-info">
                <p class="h1 text-center">Chat Room</p>
                <div id="chat-area" class="px-4" style="height:500px;background:white;overflow:scroll;overflow-x:hidden;"></div>
                <form id="message">
                    <div class="form-group">
                        <p id="username-box"><?php echo isset($sess_username)?$sess_username:"Guest"?></p>
                        <textarea id="msg" maxlength="100" class="form-control"></textarea><br> 
                        <button id="btn_sendMsg" class="btn btn-block btn-primaryLight btn-primary">Send</button>
                    </div>
                </form>
            </div>
            <br>
        </div>
        <br/>

        <?php printFooter(); ?>
        <script type="module" src="../javascript/gps_handle.js"></script>
        <script type="module" src="../javascript/chatroom.js"></script>
        <script type="module" src="../javascript/customerDeliveryStatus.js"></script>
    </body>
</html>