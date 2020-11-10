<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Sales Analysis Module</title>
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
            
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script src="../javascript/contact_script.js" ></script>
    </body>
</html>
