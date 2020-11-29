//import Chart from "chart.js"

$(()=>{
    $("#generateGraph").on("click",(e)=>{
        e.preventDefault(); 
        $("#graph").remove();
        $("#content").append('<canvas id="graph" aria-label="chartjs_graph" role="graph"></canvas>');
        generateGraph();
    });

    $("#timeRange").on("change",(e)=>{
        let date = new Date();
        let today = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

        let value = $("#timeRange").val() as string;
        if(value === "userDecide"){
            $("#user_define").html(`<div class="form-group">
                                    <label for = "from_date">Start Date:</label><br>
                                    <input type='date' class = 'form-control' id='from' name='from' max='${today}'>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for = "to_date">End Date:</label><br>
                                    <input type='date' class = 'form-control' id='to' name='to' max='${today}'>
                                    </div>
                                    `);
            
            $("#from").on("change",(e)=>{
                let value = $("#from").val() as string;
                $("#to").attr("min",value);
            });
        
            $("#to").on("change",(e)=>{
                let value = $("#to").val() as string;
                $("#from").attr("max",value);
                
            });
        }else{
            $("#user_define").html("");
        }
    })
});

function generateGraph() : void {
    let dataType = $("#dataType").val() as string;
    let timeRange = $("#timeRange").val() as string;
    if(timeRange === 'userDecide'){
        let from = $("#to").val();
        let to = $("#from").val();
        $.ajax({
            url:"../php/getDataSet.php",
            method:"post",
            dataType:"json",
            data:{
                dataType:dataType,
                timeRange:timeRange,
                from:from,
                to:to
            },
            success:printGraph
        });
    }
    else{
        $.ajax({
            url:"../php/getDataSet.php",
            method:"post",
            dataType:"json",
            data:{
                dataType:dataType,
                timeRange:timeRange
            },
            success:printGraph
        });
    }
}

function printGraph(data: any){
    let canvas = ((document.getElementById("graph")! as HTMLCanvasElement).getContext("2d")) as CanvasRenderingContext2D;
    let chartType = $("#chartType").val() as string;
    let dataset = data;
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