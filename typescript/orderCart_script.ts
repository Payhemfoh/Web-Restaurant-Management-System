import { errorModal } from "./errorFunction.js";

$(function(){
    $(".btn-detail").on("click",function(){
        let id = this.getAttribute("value");

        //post ajax call to print the information
        $.ajax("../webpage/displayMenuDetail.php",{
            method:"POST",
            dataType:"HTML",
            data:{id:id},
            success: function(data,status,xhr){
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" '+
                                        'data-dismiss="modal">Return to Cart</button>');
                ($("#modal") as any).modal();
            } ,
            error: errorModal
        });
    });

    $("#btn_checkout").on("click",()=>{
        let form = $("<form action='../webpage/payment.php'></form>");
        $("body").append(form);
        form.trigger("submit");
    });

    $("#btn_payment").on("click",()=>{
        let form = $("<form action='../webpage/payment.php'></form>");
        $("body").append(form);
        form.trigger("submit");
    });

    $("#btn_sendKitchen").on("click",()=>{

    });
});