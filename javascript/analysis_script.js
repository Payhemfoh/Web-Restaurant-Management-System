"use strict";
//import Chart from "chart.js"
$(function () {
    $("#generateGraph").on("click", function (e) {
        e.preventDefault();
        $("#graph").remove();
        $("#content").append('<canvas id="graph" aria-label="chartjs_graph" role="graph"></canvas>');
        generateGraph();
    });
});
function generateGraph() {
    var canvas = (document.getElementById("graph").getContext("2d"));
    var dataset = {};
    var chartType = $("#chartType").val();
    $.ajax({
        url: "../php/getDataSet.php",
        dataType: "json",
        success: function (data) {
            dataset = data;
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
    });
}
