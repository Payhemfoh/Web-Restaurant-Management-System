"use strict";
//import Chart from "chart.js"
$(function () {
    $("#generateGraph").on("click", function (e) {
        e.preventDefault();
        $("#graph").remove();
        $("#content").append('<canvas id="graph" aria-label="chartjs_graph" role="graph"></canvas>');
        generateGraph();
    });
    $("#timeRange").on("change", function (e) {
        var date = new Date();
        var today = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        var value = $("#timeRange").val();
        if (value === "userDecide") {
            $("#user_define").html("<div class=\"form-group\">\n                                    <label for = \"from_date\">Start Date:</label><br>\n                                    <input type='date' class = 'form-control' id='from' name='from' max='" + today + "'>\n                                    </div>\n                                    \n                                    <div class=\"form-group\">\n                                    <label for = \"to_date\">End Date:</label><br>\n                                    <input type='date' class = 'form-control' id='to' name='to' max='" + today + "'>\n                                    </div>\n                                    ");
            $("#from").on("change", function (e) {
                var value = $("#from").val();
                $("#to").attr("min", value);
            });
            $("#to").on("change", function (e) {
                var value = $("#to").val();
                $("#from").attr("max", value);
            });
        }
        else {
            $("#user_define").html("");
        }
    });
});
function generateGraph() {
    var dataType = $("#dataType").val();
    var timeRange = $("#timeRange").val();
    if (timeRange === 'userDecide') {
        var from = $("#to").val();
        var to = $("#from").val();
        $.ajax({
            url: "../php/getDataSet.php",
            method: "post",
            dataType: "json",
            data: {
                dataType: dataType,
                timeRange: timeRange,
                from: from,
                to: to
            },
            success: printGraph
        });
    }
    else {
        $.ajax({
            url: "../php/getDataSet.php",
            method: "post",
            dataType: "json",
            data: {
                dataType: dataType,
                timeRange: timeRange
            },
            success: printGraph
        });
    }
}
function printGraph(data) {
    var canvas = (document.getElementById("graph").getContext("2d"));
    var chartType = $("#chartType").val();
    var dataset = data;
    var chart = new Chart(canvas, {
        //type of chart
        type: chartType,
        //data for dataset
        data: dataset,
        //addition parameter for chart setting
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
            }
        }
    });
}
