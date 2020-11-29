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
            <div class="container row">
                <div class='col text-center'>
                    <input type='radio' value='e-wallet' class='payment_method' name='payment_method'> E-Wallet
                </div>
                <div class='col text-center'>
                    <input type='radio' value='card' class='payment_method' name='payment_method'> Credit/Debit Card
                </div>
                <div class='col text-center'>
                    <input type='radio' value='cash' class='payment_method' name='payment_method'> 
                    <?php echo $_COOKIE['service']==="delivery"? "Pay when arrived":"Counter Pay"; ?>
                </div>
            </div>
            <br><br>
            <hr>

            <div id="methodBlock">

            </div>
            <br><br>
            <hr>

            <div id='paymentBlock'>
            </div>
            <br><br>
            <?php
            if(!isset($_COOKIE['service']))
                $service = "";
            else
                $service = $_COOKIE['service'];
            
            if(!isset($_COOKIE['orderId']))
                $orderId = 0;
            else
                $orderId = $_COOKIE['orderId'];

            printf("<input id='service' type='hidden' value='%s' />
            <input id='orderID' type='hidden' value='%d' />",$service,$orderId);
            
            echo "<button id='complete-payment' class='btn btn-block btn-primaryLight btn-primary' style='display:none;'>Complete Payment</button>";
            ?>
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter(); ?>

        <script type="module" src="../javascript/paymentModule_script.js"></script>
    </body>
</html>
