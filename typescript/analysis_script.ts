//import Chart from "chart.js"

$(()=>{
    let canvas = ((document.getElementById("graph")! as HTMLCanvasElement).getContext("2d")) as CanvasRenderingContext2D;
    let dataset = {};
    $.ajax({
        url:"../php/getDataSet.php",
        dataType:"json",
        success:(data)=>{
            dataset = {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            } ;
            console.log(dataset);
            dataset = data;
            console.log(dataset);
            let chart = new Chart(canvas,{
                //type of chart
                type:"bar",
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
    
})