import { Chat } from "./Chat.js";


$(()=>{
    let username = $("#username").val() as string;
    let file = $("#chatFile").val() as string;
    let chat = new Chat(file);
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

    $("#btn_arrived").on("click",orderArrived);

    Updating();

    function Updating(){
        chat.update();
        setTimeout(Updating,5000);
    }
});

function orderArrived(e:Event):void{
    e.preventDefault();
    let delivery_id = $("#delivery_id").val();
    console.log(delivery_id);
    $.ajax({
        url:"../php/completeDelivery.php",
        method:"post",
        dataType:"html",
        data:{delivery_id:delivery_id},
        success:(data)=>{
            console.log(data);
            $("#modal-title").text("Delivery Request Completed");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#btnAgain").attr("data-dismiss","modal");
            $("#btnAgain").on("click",()=>{
                location.reload();
            });
            ($("#modal") as any).modal();
            setTimeout(()=>$("#btnAgain").trigger("click"),1000);
        }
    });
}