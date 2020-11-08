<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Payment</title>
        <?php 
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
            <br><h3>Payment</h3><br>

            <label for="paymentMethod">Select Payment Method:</label><br>
            <div class="btn-group">
                <button id="btn_eWallet" class="btn btn-primary">e-wallet</button>
                <button id="btn_card" class="btn btn-primary">Credit/debit Card</button>
                <button id="btn_cash" class="btn btn-primary">Counter Pay/Pay when arrived</button>
            </div>
            <br><br>
            
            <div id="paymentBlock" class="">

            </div>
        </div>
        <br/>

        <?php printModal(); ?>
        <?php printFooter(); ?>

        <script type="module" src="../javascript/paymentModule_script.js"></script>
    </body>
</html>