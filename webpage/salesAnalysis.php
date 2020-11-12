<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Sales Analysis</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
        <script src="https://d3js.org/d3.v6.min.js"></script>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>

        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <div id="graph"></div>
            
        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/analysis_script.js" ></script>
    </body>
</html>