//import Chart from "chart.js"

$(()=>{
    $("#generateGraph").on("click",(e)=>{
        e.preventDefault(); 
        $("#graph").remove();
        $("#content").append('<canvas id="graph" aria-label="chartjs_graph" role="graph"></canvas>');
        generateGraph();
    });
});

function generateGraph() : void {
    let canvas = ((document.getElementById("graph")! as HTMLCanvasElement).getContext("2d")) as CanvasRenderingContext2D;
    let dataset = {};
    let chartType = $("#chartType").val() as string;
    $.ajax({
        url:"../php/getDataSet.php",
        dataType:"json",
        success:(data)=>{
            dataset = data;
            let chart = new Chart(canvas,{
                //type of chart
                type:chartType,
                //data for dataset
                data:dataset,
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