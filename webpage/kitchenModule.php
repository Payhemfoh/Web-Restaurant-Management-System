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
            <br><h2 class="text-center">Kitchen Module</h2><br><br>
            <div id="order_requests">
            </div>
            <button id='btn_history' class='btn btn-primary btn-primaryLight btn-block'>Completed Order History</button>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/kitchenModule_script.js" ></script>
    </body>
</html>