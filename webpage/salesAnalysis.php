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
            <form>
                <div class="form-group">
                    <select id="dataType" class='form-control'>
                        <option value="sales">Sales</option>
                        <option value="order">Order Popularity</option>
                    </select>
                </div>

                <div class="form-group">
                    <select id="timeRange" class='form-control'>
                        <option value="24hours">Last 24 hours</option>
                        <option value="30days">Last 30 days</option>
                        <option value="12months">Last 12 months</option>
                        <option value="5years">Last 5 year</option>
                        <option value="norange">No range</option>
                    </select>
                </div>

                <div class="form-group">
                    <select id="chartType" class='form-control'>
                        <option value="bar">bar</option>
                        <option value="line">line</option>
                        <option value="doughnut">doughnut</option>
                        <option value="pie">pie</option>
                    </select>
                </div>
                <br>
                <button id="generateGraph" class="btn btn-block btn-primaryLight btn-primary">Generate Graph</button>
                <br><br>
            </form>
            <canvas id="graph" aria-label="chartjs_graph" role="graph"></canvas>

        </div>
        <br/>
        <?php printModal(); ?>
        <?php printFooter(); ?>
        <script type="module" src="../javascript/analysis_script.js" ></script>
    </body>
</html>