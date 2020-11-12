import { Chat } from "./Chat.js";


$(()=>{
    let username = $("#customer_username").val() as string;
    let delivery_id = $("#delivery_id").val();
    let chat = new Chat(username+"_"+delivery_id+".txt");
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

    Updating();

    function Updating(){
        chat.update();
        setTimeout(Updating,5000);
    }
});

