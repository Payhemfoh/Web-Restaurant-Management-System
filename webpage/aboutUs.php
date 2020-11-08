<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | About Us</title>
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
            <br><h2 class="text-center">About Us</h2><br><br>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script src="../javascript/homepage_script.js" ></script>
    </body>
</html>