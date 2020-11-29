import { showPasswordSetting } from "./form_handle.js";

$(()=>{
    loadOrder();
    $(".payment_method").on("change",(e)=>{
        let value = e.target.getAttribute("value");
        $("#paymentBlock").html("");
        $("#complete-payment").css("display","none");
        $.ajax({
            url:"../php/loadPaymentMethod.php",
            method:"post",
            dataType:"html",
            data:{payment_method:value},
            success:(data)=>{
                $("#methodBlock").html(data);
                switch(value){
                    case "e-wallet":
                        $(".wallet_method").on("click",()=>{
                            $("#paymentBlock").html("<div class='text-center'><img src='../images/Payment/e_wallet.png' class=\"img-thumbnail\"></div>");
                            $("#complete-payment").css("display","block");
                        });
                        break;
                    case "card":
                        $("#complete-payment").css("display","block");
                        showPasswordSetting($("#cvv"),$("#showcvv"));
                        break;
                    case "cash":
                        let service = $("#service").val() as string;
                        let orderId = $("#orderID").val() as number;
                        let price = $("#totalPrice").val() as number;
                        if(service === "delivery"){
                            $("#paymentBlock").html("<h4>Your order id is "+orderId+".<br>"+
                                                    "The total price is RM"+price+"<br>"+
                                                    "Our staff will receive the payment when the order is arrived."+
                                                    "<br>Thank you</h4><br><br>");
                        }else{
                            $("#paymentBlock").html("<h4>Your order id is "+orderId+".<br>"+
                                                    "The total price is RM"+price+"<br>"+
                                                    "Please pay before exit the store."+
                                                    "<br>Thank you</h4><br><br>");
                        }
                        break;
                }
            }
        })
    });

    $("#complete-payment").on("click",()=>{
        let service = $("#service").val() as string;
        let payment_method = $(".payment_method:checked").val() as string;
        let price = $("#totalPrice").val() as number;
        
        $.ajax({
            url:"../php/payment_process.php",
            method:"post",
            dataType:"html",
            data:{
                payment_method:payment_method,
                totalPrice : price
            },
            success:(data)=>{
                $("#modal-title").text("Complete Payment");
                $(".modal-body").html(data);
                $(".modal-footer").html("");
                if(service === "delivery"){
                    let form = $("<form action='../webpage/setLocation.php'></form>");
                    $(".modal-body").append(form);
                    setTimeout(()=>form.trigger("submit"),5000);
                    $("#complete").on("click",()=>{
                        form.trigger("submit");
                    });
                }else{
                    let form = $("<form action='../webpage/homepage.php'></form>");
                    $(".modal-body").append(form);
                    setTimeout(()=>form.trigger("submit"),5000);
                    $("#complete").on("click",()=>{
                        form.trigger("submit")
                    });
                }
                ($("#modal") as any).modal();
            }
        })

    });
});

function loadOrder():void{
    let orderId = $("#orderId").val();
    $.ajax({
        url:"../php/loadOrderItem.php",
        method:"post",
        dataType:"html",
        data:{orderId:orderId},
        success:(data)=>$("#order_item_list").html(data)
    });
}
