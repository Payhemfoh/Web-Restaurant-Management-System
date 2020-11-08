<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Homepage</title>
        <?php
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <?php include("../webpage/categoryList.php");?>
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/orderList_script.js"></script>
    </body>
</html>