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
                        error:function(xhr,status,error){
                            if(xhr && xhr.status!=200){
                                $("#modal-title").text("Error");
                                $(".modal-body").html("Failed to send request to server: <br> "+xhr.responseText+"<br>Please try again.<br>");
                                $(".modal-footer").html("<button id=\"cancel\" class=\"btn btn-primary "+ 
                                                        "btn-primaryLight btn-block\" data-dismiss=\"modal\">Cancel</button>");
                            }else{
                                alert("Failed to send request to server! Please try again!");
                            }
                        }
                    });
                });
            
                $("#btn-no").attr("data-dismiss","modal");
            },
            error:function(xhr,status,error){
                if(xhr && xhr.status!=200){
                    $("#modal-title").text("Error");
                    $(".modal-body").html("Failed to send request to server: <br> "+xhr.responseText+"<br>Please try again.<br>");
                    $(".modal-footer").html("<button id=\"cancel\" class=\"btn btn-primary "+ 
                                            "btn-primaryLight btn-block\" data-dismiss=\"modal\">Cancel</button>");
                    ($("#modal") as any).modal();
                }else{
                    alert("Failed to send request to server! Please try again!");
                }
            }
        })
    });
});