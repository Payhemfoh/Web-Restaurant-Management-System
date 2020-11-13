import { errorModal } from "./errorFunction.js";
import { inValidInput, validInput } from "./form_handle.js";


$(function(){
    ($("#table") as any).DataTable();

    //add new stock button
    $(".btn_add").on("click",setAddButton);

    $(".btn_delete").on("click",setDeleteButton);


    $(".btn_edit").on("click",setEditButton);
});

function readFile(this: any){
    let input = this;
    if(input.files && input.files[0]){
        let reader = new FileReader();
        reader.onload = (e) =>{
            let imgData = (e.target)!.result;
            let imgName = (input.files)![0].name;
            input.setAttribute("data-title",imgName);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function setAddButton() : void {
    $.ajax("../webpage/addNewMenu.php",{
        method:"post",
        dataType:"HTML",
        success:function(data,status,xhr){
            $("#modal-title").text("Add New Menu Data");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#newImg").on("change",readFile);

            $("#modal-submit").on("click",function(e){
                e.preventDefault();

                //get user input
                let formData = new FormData();
                let name = $("#name_input").val() as string;
                let category = ($("#category_input").val()) as number;
                let price = $("#price_input").val() as number;
                let description = $("#description_input").val() as string;
                let fileInput = document.getElementById("newImg") as HTMLInputElement;
                let valid = true;

                //validation
                if(name === ""){
                    inValidInput($("#name_input"),$("#name-feedback"),"The name should not be empty!");
                    valid = false;
                }else{
                    validInput($("#name_input"),$("#name-feedback"));
                }

                if(fileInput.files && fileInput.files[0]){
                    let image = fileInput.files[0];
            
                    formData.append("image",image);
                    formData.append("destination","../images/MenuManagement/");
                }

                if(valid){
                    formData.append("name",name);
                    formData.append("category",category.toString());
                    formData.append("price",price.toString());
                    formData.append("description",description);
                    
                    //post ajax call
                    $.ajax("../php/addNewMenu_process.php",{
                        method:"post",
                        dataType:"html",
                        data:formData,
                        processData:false,
                        contentType:false,
                        success:function(data){
                            $("#modal-title").text("Add New Stock Data");
                            $(".modal-body").html(data);
                            $(".modal-footer").html("");
                            $("#btnAgain").attr("data-dismiss","modal");
                            $("#btnAgain").on("click",()=>location.reload());
                        },
                        error:errorModal
                    });
                    
                }
            });
            $("#modal-cancel").attr("data-dismiss","modal");

            ($("#modal") as any).modal();
        },
        error:errorModal

    });
}

function setDeleteButton(this: any):void{
    let id = this.getAttribute("value");

    $.ajax("../webpage/deleteMenu.php",{
        method:"post",
        dataType:"html",
        data:{id:id},
        success:(data)=>{
            $("#modal-title").text("Delete Menu Data");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            
            $("#modal-submit").on("click",(e)=>{
                e.preventDefault();
                $.ajax("../php/deleteMenu_process.php",{
                    method:"POST",
                    dataType:"HTML",
                    data:{id:id},
                    success:(data)=>{
                        $("#modal-title").text("Menu Data Deleted");
                        $(".modal-body").html(data);
                        $(".modal-footer").html("");
                        $("#btnAgain").attr("data-dismiss","modal");
                        $("#btnAgain").on("click",()=>location.reload());
                    },
                    error:errorModal
                });
            })
            $("#modal-cancel").attr("data-dismiss","modal");

            ($("#modal") as any).modal();
        },
        error:errorModal
    });
}

function setEditButton(this:any):void{
    let id = this.getAttribute("value");

    $.ajax("../webpage/modifyMenu.php",{
        method:"post",
        dataType:"HTML",
        data:{id:id},
        success:function(data,status,xhr){
            $("#modal-title").text("Modify Menu");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#newImg").on("change",readFile);

            $("#modal-cancel").attr("data-dismiss","modal");
            $("#modal-submit").on("click",function(e){
                e.preventDefault();

                //get user input
                let formData = new FormData();
                let name = $("#name_input").val() as string;
                let category = ($("#category_input").val()) as number;
                let price = $("#price_input").val() as number;
                let description = $("#description_input").val() as string;
                let fileInput = document.getElementById("newImg") as HTMLInputElement;
                let valid = true;

                //validation
                if(name === ""){
                    inValidInput($("#name_input"),$("#name-feedback"),"The name should not be empty!");
                    valid = false;
                }else{
                    validInput($("#name_input"),$("#name-feedback"));
                }

                if(fileInput.files && fileInput.files[0]){
                    let image = fileInput.files[0];
            
                    formData.append("image",image);
                    formData.append("destination","../images/MenuManagement/");
                }

                if(valid){
                    formData.append("name",name);
                    formData.append("category",category.toString());
                    formData.append("price",price.toString());
                    formData.append("description",description);
                    formData.append("id",id);
                    
                    //post ajax call
                    $.ajax("../php/updateMenu_process.php",{
                        method:"post",
                        dataType:"html",
                        data:formData,
                        processData:false,
                        contentType:false,
                        success:function(data){
                            $("#modal-title").text("Add New Stock Data");
                            $(".modal-body").html(data);
                            $(".modal-footer").html("");
                            $("#btnAgain").attr("data-dismiss","modal");
                            $("#btnAgain").on("click",()=>location.reload());
                        },
                        error:errorModal
                    });
                    
                }
            });
            $("#modal-cancel").attr("data-dismiss","modal");

            ($("#modal") as any).modal();
        },
        error:errorModal

    });
}