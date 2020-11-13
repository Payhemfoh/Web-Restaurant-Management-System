//import Chart from "chart.js"

$(()=>{
    let canvas = ((document.getElementById("graph")! as HTMLCanvasElement).getContext("2d")) as CanvasRenderingContext2D;
    let dataset = {};
    $.ajax({
        url:"../php/getDataSet.php",
        dataType:"json",
        success:(data)=>{
            dataset = data;
            let chart = new Chart(canvas,{
                //type of chart
                type:"bar",
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
    
})