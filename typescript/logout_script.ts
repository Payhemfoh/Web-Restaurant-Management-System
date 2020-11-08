import { errorModal } from "./errorFunction.js";

$(function(){
    $("#logout_menu").on("click",function(){
        $.ajax("../webpage/logout.php",{
            method:"POST",
            dataType:"HTML",
            success:function(data,status,xhr){
                $("#modal-title").text("Logout");
                $(".modal-body").html(data);
                $(".modal-footer").text("");
                ($("#modal") as any).modal();

                $("#btn-yes").on("click",function(){
                    $.ajax("../php/logout_process.php",{
                        method:"POST",
                        dataType:"HTML",
                        success:function(data,status,xhr){
                            $("#modal-title").text("Logout");
                            $(".modal-body").html(data);
                            $(".modal-footer").text("");
                        },
                        error:errorModal
                    });
                });
            
                $("#btn-no").attr("data-dismiss","modal");
            },
            error:errorModal
        })
    });
});