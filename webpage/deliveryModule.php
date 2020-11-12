<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Kitchen Module</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();

            if(!isset($sess_username) || $sess_position == "customer" || $sess_permission->deliveryModule !=="T"){
                header('Refresh: 0; URL=../webpage/homepage.php');
            }
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <br><h2 class="text-center">Delivery Module</h2><br><br>
            <div id="delivery_requests">
            </div>
            <?php
             echo "<input type='hidden' id='username' value='$sess_username'>"
            ?>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/deliveryModule_script.js" ></script>
    </body>
</html>