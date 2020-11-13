import { errorModal } from "./errorFunction.js";
import { validInput,inValidInput } from "./form_handle.js";

$(function(){
    ($("#table") as any).DataTable();

    //add new stock button
    $(".btn_add").on("click",function(){
        $.ajax("../webpage/addNewStock.php",{
            method:"post",
            dataType:"HTML",
            success:function(data,status,xhr){
                $("#modal-title").text("Add New Stock Data");
                $(".modal-body").html(data);
                $(".modal-footer").html("");

                $("#modal-submit").on("click",function(e){
                    e.preventDefault();

                    //get user input
                    let name = $("#name_input").val();
                    let quantity = ($("#quantity_input").val()) as number;
                    let description = $("#description_input").val();
                    let valid = true;

                    //validation
                    if(name === ""){
                        inValidInput($("#name_input"),$("#name-feedback"),"The name should not be empty!");
                        valid = false;
                    }else{
                        validInput($("#name_input"),$("#name-feedback"));
                    }

                    if(quantity<0){
                        inValidInput($("#quantity_input"),$("#quantity-feedback"),"The quantity should not below 0!");
                        valid = false;
                    }else{
                        validInput($("#quantity_input"),$("#quantity-feedback"));
                    }

                    if(description === ""){
                        inValidInput($("#description_input"),$("#description-feedback"),"The description should not be empty!");
                        valid = false;
                    }else{
                        validInput($("#description_input"),$("#description-feedback"));
                    }

                    if(valid){
                        //post ajax call
                        $.ajax("../php/addNewStock_process.php",{
                            method:"post",
                            dataType:"HTML",
                            data:{
                                name:name,
                                quantity:quantity,
                                description:description
                            },
                            success:function(data,status,xhr){
                                $("#modal-title").text("Add New Stock Data");
                                $(".modal-body").html(data);
                                $(".modal-footer").html("");
                                $("#btnAgain").attr("data-dismiss","modal");
                                $("#btnAgain").on("click",()=>{location.reload();});
                            },
                            error:errorModal
                        })
                    }
                });
                $("#modal-cancel").attr("data-dismiss","modal");

                ($("#modal") as any).modal();
            },
            error:errorModal

        });
    });



    
    $(".btn_delete").on("click",function(){
        let id = this.getAttribute("value");

        $.ajax("../webpage/deleteStock.php",{
            method:"POST",
            dataType:"HTML",
            data:{id:id},
            success:function(data,status,xhr){
                $("#modal-title").text("Delete Stock Data");
                $(".modal-body").html(data);
                $(".modal-footer").html("");
                $("#modal-cancel").attr("data-dismiss","modal");
                $("#modal-submit").on("click",function(e){
                    e.preventDefault();
                    $.ajax("../php/deleteStock_process.php",{
                        method:"POST",
                        dataType:"HTML",
                        data:{id:id},
                        success:function(data,status,xhr){
                            $("#modal-title").text("Stock Data Deleted");
                            $(".modal-body").html(data);
                            $(".modal-footer").html("");
                            $("#btnAgain").attr("data-dismiss","modal");
                            $("#btnAgain").on("click",()=>{location.reload();});
                        },
                        error:errorModal
                    })
                });
                
                ($("#modal") as any).modal();
            },
            error:errorModal
        });

    })

    //edit stock button
    $(".btn_edit").on("click",function(){
        let id = this.getAttribute("value");

        $.ajax("../webpage/modifyStock.php",{
            method:"post",
            dataType:"HTML",
            data:{id:id},
            success:function(data,status,xhr){
                $("#modal-title").text("Edit Stock Data");
                $(".modal-body").html(data);

                $(".modal-footer").html("");

                $("#modal-submit").on("click",function(e){
                    e.preventDefault();

                    //get user input
                    let name=$("#name_input").val();
                    let quantity = ($("#quantity_input").val())as number;
                    let description = $("#description_input").val();
                    let valid = true;

                    //validation
                    if(name === ""){
                        inValidInput($("#name_input"),$("#name-feedback"),"The name should not be empty!");
                        valid = false;
                    }else{
                        validInput($("#name_input"),$("#name-feedback"));
                    }

                    if(quantity<0){
                        inValidInput($("#quantity_input"),$("#quantity-feedback"),"The quantity should not below 0!");
                        valid = false;
                    }else{
                        validInput($("#quantity_input"),$("#quantity-feedback"));
                    }

                    if(description === ""){
                        inValidInput($("#description_input"),$("#description-feedback"),"The description should not be empty!");
                        valid = false;
                    }else{
                        validInput($("#description_input"),$("#description-feedback"));
                    }

                    if(valid){
                        $.ajax("../php/updateStock_process.php",{
                            method:"POST",
                            dataType:"HTML",
                            data:{
                                id:id,
                                name:name,
                                quantity:quantity,
                                description:description,
                            },
                            success:function(data,status,xhr){
                                $("#modal-title").text("Modify Stock Data");
                                $(".modal-body").html(data);
                                $(".modal-footer").html("");
                                $("#btnAgain").attr("data-dismiss","modal");
                                $("#btnAgain").on("click",()=>{location.reload();});
                            },
                            error:errorModal
                        });
                    }
                });
                ($("#modal") as any).modal();
            },
            error:errorModal
        });
    })
});