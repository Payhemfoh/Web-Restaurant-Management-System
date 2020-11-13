<?php
    include("../php/sessionFragment.php");
?>

<div id="gps" class="alert alert-info">
    <p class="h1 text-center">Destination</p>
    <p id="location" class="text-center">
    <?php 
        $delivery_id = $_COOKIE['delivery_id'];

        //database connection
        $connect = new mysqli("localhost","root","","rms_database");

        //check connection
        if($connect->connect_error){
            die("Connection error : $connect->connect_errno : $connect->connect_error");
        }

        if($statement = $connect->prepare("SELECT * 
                                            FROM delivery d,orders o,customer c 
                                            WHERE d.delivery_id=? 
                                            AND d.delivery_id = o.delivery_id
                                            AND o.customer_id = c.customer_id
                                            LIMIT 1;")){
            $statement->bind_param("s",$delivery_id);
            $statement->execute();
            $delivery_result = $statement->get_result();
            while($row = $delivery_result->fetch_array()){
                echo $row['customer_address'];
                echo "<input type='hidden' id='staff_latitude' value='0'>";
                echo "<input type='hidden' id='staff_longitude' value='0'>";
                echo "<input type='hidden' id='delivery_id' value='$delivery_id'>";
                echo "<input type='hidden' id='customer_username' value='".$row['username']."'>";
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
    <br>
    <form id="message">
        <div class="form-group">
            <p id="username-box" class='h4'><?php echo isset($sess_username)?$sess_username:"Staff"?></p>
            <textarea id="msg" maxlength="100" class="form-control"></textarea><br> 
            <button id="btn_sendMsg" class="btn btn-block btn-primaryLight btn-primary">Send</button>
        </div>
    </form>
</div>

<button id="btn_arrived" class="btn btn-block btn-primaryLight btn-primary">Arrived</button>
<script type="module" src='../javascript/gps_handle_staff.js'></script>
<script type="module" src="../javascript/chatroom_staff.js"></script>

