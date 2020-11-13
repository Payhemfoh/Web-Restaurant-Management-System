<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Homepage</title>
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
            <br><h2 class="text-center">Welcome to RMS</h2><br><br>
            
            <?php
            if(empty($sess_username)){
                echo '
                <div class="alert alert-info">
                    <h3 class="text-center">Are you first time to this website?</h3>
                    <a href="../webpage/register.php" class="btn btn-block btn-lg btn-outline-primary">If yes, click here to register</a>
                    <a href="../webpage/login.php" class="btn btn-block btn-lg btn-outline-primary">or click here to login</a>
                </div>';
            }
            ?>
            
            
            <div class="alert">
            <h3 class="text-center">Please select your service</h3>
            <button id="dine-in" class="btn btn-block btn-lg btn-outline-primary">Dine In</button>
            <button href="orderList.html" id="take-away" class="btn btn-block btn-lg btn-outline-primary">Take Away</button>
            <button id="delivery" class="btn btn-block btn-lg btn-outline-primary">Delivery</button>
            </div>
            <br/><br/>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type='module' src="../javascript/homepage_script.js" ></script>
    </body>
</html>