<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RMS | Sales Analysis</title>
        <?php 
            require("../php/sessionFragment.php");
            require("../php/pageFragment.php");
            printHeadInclude();
        ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    </head>

    <body class="bg-light">
        <?php printHeader(basename(__FILE__)); ?>
        <br><h3 class="text-center">Sales Analysis</h3><br>
        <br/>
        <div id="content" class="container bg-light col-md-9 rounded">
            <canvas id="graph" aria-label="chartjs_graph" role="graph"></canvas>

        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/analysis_script.js" ></script>
    </body>
</html>