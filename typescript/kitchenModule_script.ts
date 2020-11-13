import { errorModal } from "./errorFunction.js";

$(()=>{
    loop();
});

function loop() : void{
    update();
    setTimeout(loop,60000);
}

function update():void{
    $.ajax("../php/loadOrderRequest.php",{
        method:"post",
        dataType:"html",
        success:(data)=>{
            $("#order_requests").html(data);

            $(".btn_done").on("click",(e)=>{
                let itemId = e.target.getAttribute("value");
                $.ajax("../php/completeOrderItem.php",{
                    dataType:"html",
                    method:"post",
                    data:{
                        id:itemId
                    },
                    success:(data)=>{
                        $("#modal-title").text("Order Done");
                        $(".modal-body").html(data);
                        $(".modal-footer").html("");
                        $("#btnAgain").attr("data-dismiss","modal");
                        $("#btnAgain").on("click",()=>location.reload());
                        ($("#modal") as any).modal();
                        setTimeout(()=>$("#btnAgain").trigger("click"),500);
                    },
                    error:errorModal
                });
            });
        },
        error:()=>{
            $("#order_requests").html("<h3 class='text-center'>Failed to load data from database</h3>");
        }
    });
}