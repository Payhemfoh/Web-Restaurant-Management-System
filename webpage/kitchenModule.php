<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Kitchen Module</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();

            if(!isset($sess_username) || $sess_position == "customer" || $sess_permission->orderManagementModule !=="T"){
                header('Refresh: 0; URL=../webpage/homepage.php');
            }
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <br><h2 class="text-center">Order Checking Module</h2><br><br>
            <div id="general_view">
            </div>
            <div id="order_requests">
            </div>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script src="../javascript/kitchenModule_script.js" ></script>
    </body>
</html>