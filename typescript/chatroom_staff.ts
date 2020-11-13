import { Chat } from "./Chat.js";


$(()=>{
    let username = $("#username-box").text() as string;
    let customer_username = $("#customer_username").val() as string;
    let delivery_id = $("#delivery_id").val();
    let chat = new Chat(customer_username+"_"+delivery_id+".txt");
    chat.getState();

    $("#msg").on("keyup",(e)=>{
        if(e.key == "Enter"){   
            let text = $("#msg").val() as string;
            let max = parseInt($("#msg").attr("maxlength") as string);
            let length = text.length;

            if(length <= max + 1){
                chat.sendMsg(text,username);
                $("#msg").val("");
            }else{
                $("#msg").val(text.substring(0,max));
            }
        }
    });

    $("btn_arrived").on("click",orderArrived);

    Updating();

    function Updating(){
        chat.update();
        setTimeout(Updating,5000);
    }
});

function orderArrived():void{
    let delivery_id = $("#delivery_id").val();
    $.ajax({
        url:"../php/completeDelivery.php",
        method:"post",
        dataType:"html",
        data:{delivery_id:delivery_id},
        success:(data)=>{
            $("#modal-title").text("Delivery Request Completed");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#btnAgain").attr("data-dismiss","modal");
            setTimeout(()=>$("#btnAgain").trigger("click"),1000);
        }
    });
}