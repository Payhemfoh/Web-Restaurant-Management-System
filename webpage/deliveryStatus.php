<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Delivery Status</title>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAD1DxO02YcvRjKIgmOQoNoU1neglwQr0w&v=weekly"
      defer></script>
        <?php 
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
                            <th>No</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Chicken Rice</td>
                            <td>3</td>
                            <td>RM7.00</td>
                            <td>RM21.00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Egg Sandwich</td>
                            <td>2</td>
                            <td>RM5.00</td>
                            <td>RM10.00</td>
                    </tbody>
                </table>
            </div>
            <br><hr>

            <div id="status" class="alert">
                <br><h3 class="text-center">Your food status</h3><br>
                <div class="progress" style="height: 20px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                    role="progress-bar" style="width:50%" aria-valuenow="2" aria-valuemin="0" aria-valuemax="4">
                    50%
                    </div>
                </div>
                <br>
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item flex-fill noaction"><span class="page-link text-center">Waiting</span></li>
                    <li class="page-item active flex-fill noaction"><span class="page-link text-center">Preparing</span></li>
                    <li class="page-item flex-fill noaction"><span class="page-link text-center">Delivering</span></li>
                    <li class="page-item flex-fill noaction"><span class="page-link text-center">Arrived</span></li>
                </ul>
            </div>
            <br>

            <div id="gps" class="alert alert-info">
                <p class="h1 text-center">Your Location</p>
                <p id="location"><?php print_r($_COOKIE);?></p>
                <div id="map" style="height:500px;"></div>
            </div>

            <div id="chatbox" class="alert alert-info">
                <p class="h1 text-center">Chat Room</p>
                <div id="chat-area" style="height:500px;background:white;overflow:scroll;overflow-x:hidden"></div>
                <form id="message">
                    <div class="form-group">
                        <p id="username-box">Guest</p>
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
    </body>
</html>