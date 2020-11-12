<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Payment</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php
            printHeader(basename(__FILE__));
        ?>

        <br/>
        <div id="content" class="container col-md-6 rounded">
            <br><h3 class='text-center'>Payment</h3><br>
            <?php
            echo "<input type='hidden' id='orderId' value='".$_COOKIE['orderId']."'>";
            ?>
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

            <label for="paymentMethod">Select Payment Method:</label><br>
            <div class="btn-group">
                <button id="btn_eWallet" class="btn btn-primary">e-wallet</button>
                <button id="btn_card" class="btn btn-primary">Credit/debit Card</button>
                <button id="btn_cash" class="btn btn-primary">
                <?php
                    echo $_COOKIE['service']==="delivery"? "Pay when arrived":"Counter Pay";
                ?>
                </button>
            </div>
            <br><br>
            
            <div id="paymentBlock">

            </div>

            <?php
            if(!isset($_COOKIE['service']))
                $service = "";
            else
                $service = $_COOKIE['service'];
            
            if(!isset($_COOKIE['orderId']))
                $orderId = 0;
            else
                $orderId = $_COOKIE['orderId'];
            
            if(!isset($_POST['totalPrice']))
                $totalPrice = 0.0;
            else
                $totalPrice = $_POST['totalPrice'];

            printf("<input id='service' type='hidden' value='%s' />
            <input id='orderID' type='hidden' value='%d' />
            <input id='totalPrice' type='hidden' value='%.2f' />",$service,$orderId,$totalPrice);
            
            ?>
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter(); ?>

        <script type="module" src="../javascript/paymentModule_script.js"></script>
    </body>
</html>