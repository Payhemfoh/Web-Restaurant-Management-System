import { errorModal } from "./errorFunction.js";

$(()=>{
    loop();
});

function loop() : void{
    update();
    setTimeout(loop,3600);
}

function update():void{
    let username = $("#username").val();

    $.ajax("../php/loadDeliveryRequest.php",{
        method:"post",
        dataType:"html",
        data:{
            username:username
        },
        success:(data)=>{
            $("#delivery_requests").html(data);

            $(".btn_accepted").on("click",(e)=>{
                let deliveryId = e.target.getAttribute("value");
                $.ajax("../php/acceptDeliveryRequest.php",{
                    dataType:"html",
                    method:"post",
                    data:{
                        username:username,
                        deliveryId:deliveryId
                    },
                    success:(data)=>{
                        $("#modal-title").text("Delivery Request Accepted");
                        $(".modal-body").html(data);
                        $(".modal-footer").html("");
                        $("#btnAgain").attr("data-dismiss","modal");
                        $("#btnAgain").on("click",()=>{
                            update();
                        });
                        setTimeout(()=>$("#btnAgain").trigger("click"),1000);
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