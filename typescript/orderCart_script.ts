import { getCookie, orderList, setCookie } from "./cookie_manupulation.js";
import { errorModal } from "./errorFunction.js";

$(function(){
    $(".btn-detail").on("click",function(e){
        let id = parseInt(e.target.getAttribute("value") as string);
        let currentQty = parseInt(e.target.getAttribute("quantity") as string);

        //post ajax call to print the information
        $.ajax("../webpage/displayMenuDetail.php",{
            method:"POST",
            dataType:"HTML",
            data:{
                id:id,
                qty:currentQty
            },
            success: (data)=>{
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" '+
                                        'data-dismiss="modal">Return to Cart</button><br>'+
                                        '<button id="changeQuantity" class="btn btn-primary btn-primaryLight btn-block" '+
                                        '>Apply Changes</button>');
                ($("#modal") as any).modal();

                $("#changeQuantity").on("click",function(){
                    let quantity = $("#orderQty").val() as number;
                    let key = "orderList";
                    let fragment = getCookie(key);
                    let orderListObject : orderList;
                
                    if(fragment!=null && fragment!==""){
                        orderListObject = JSON.parse(fragment);
                        orderListObject.item.forEach((obj,index)=>{
                            if(obj.id === id){
                                orderListObject.item[index].qty = parseInt(quantity as any);
                            }
                        }); 
                        
                        setCookie(key+"="+JSON.stringify(orderListObject)+";path=/;");
                    }
                    
                    $(".modal-body").html("Order Quantity Changed.");
                    $(".modal-footer").html(
                        '<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" '+
                        'data-dismiss="modal">Return to menu list</button>'); 
                        $("#modal-cancel").on("click",()=>{location.reload();});
                });
            } ,
            error: errorModal
        });
    });

    $(".btn-delete").on("click",(e)=>{
        let id = parseInt(e.target.getAttribute("value") as string);
        let currentQty = parseInt(e.target.getAttribute("quantity") as string);

        $.ajax("../webpage/displayMenuDetail.php",{
            method:"POST",
            dataType:"HTML",
            data:{
                id:id,
                qty:currentQty
            },
            success: (data)=>{
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" '+
                                        'data-dismiss="modal">Return to Cart</button><br>'+
                                        '<button id="removeOrder" class="btn btn-primary btn-primaryLight btn-block" '+
                                        '>Remove From Cart</button>');
                ($("#modal") as any).modal();

                $("#removeOrder").on("click",function(){
                    let key = "orderList";
                    let fragment = getCookie(key);
                    let orderListObject : orderList;
                
                    if(fragment!=null && fragment!==""){
                        orderListObject = JSON.parse(fragment);
                        orderListObject.item = orderListObject.item.filter((value)=>value.id != id);
                        setCookie(key+"="+JSON.stringify(orderListObject)+";path=/;");
                    }
                
                    $(".modal-body").html("Order Removed.");
                    $(".modal-footer").html(
                        '<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" '+
                        'data-dismiss="modal">Return to menu list</button>'); 
                        $("#modal-cancel").on("click",()=>{location.reload();});
                });
            } ,
            error: errorModal
        });
    });

    $("#btn_checkout").on("click",()=>{
        let username = $("#username").val();
        $.ajax({
            url:"../php/sendOrderToKitchen.php",
            method:"post",
            dataType:"html",
            data:{username:username},
            success:(data)=>{
                let form = $("<form action='../webpage/payment.php'></form>");
                $("body").append(form);
                form.trigger("submit");
            },
            error:errorModal
        })
    });

    $("#btn_payment").on("click",()=>{
        let form = $("<form action='../webpage/payment.php'></form>");
        $("body").append(form);
        form.trigger("submit");
    });

    $("#btn_sendKitchen").on("click",()=>{
        let username = $("#username").val();
        $.ajax({
            url:"../php/sendOrderToKitchen.php",
            method:"post",
            dataType:"html",
            data:{
                username:username
            },
            success:(data)=>{
                let form = $("<form action='../webpage/payment.php'></form>");
                $("body").append(form);
                form.trigger("submit");
            },
            error:errorModal
        })
    });
});