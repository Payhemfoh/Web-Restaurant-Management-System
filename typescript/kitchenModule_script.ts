$(()=>{
    $.ajax("../php/loalOrderRequest.php",{
        method:"post",
        dataType:"html",
        success:(data)=>{
            $("#order_requests").html(data);
        },
        error:()=>{
            $("#order_requests").html("<h2>Failed to load data from database</h2>");
        }
    });
    
});