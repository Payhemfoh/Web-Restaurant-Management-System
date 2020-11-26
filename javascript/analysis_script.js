"use strict";
//import Chart from "chart.js"
$(function () {
    var canvas = (document.getElementById("graph").getContext("2d"));
    var dataset = {};
    $.ajax({
        url: "../php/getDataSet.php",
        dataType: "json",
        success: function (data) {
            dataset = data;
            var chart = new Chart(canvas, {
                //type of chart
                type: "bar",
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
});
