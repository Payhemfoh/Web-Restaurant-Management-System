import { errorModal } from "./errorFunction.js";

class Chat{
    private instance : boolean;
    private status : number;
    private file : string;

    constructor(filename : string){
        this.instance = false;
        this.status = 0;
        this.file = filename;
    }

    public update() : void{
        if(!this.instance){
            this.instance = true;
            $.ajax("../php/chatroom_process.php",{
                method:"post",
                dataType:"json",
                data:{
                    function:"update",
                    state:this.status,
                    file:this.file
                },
                success:(data)=>{
                    if(data.text){
                        for(let i =0;i<data.text.length;++i){
                            $("#chat-area").append(""+data.text[i]+"<br>");
                        }
                        document.getElementById("chat-area")!.scrollTop = document.getElementById("chat-area")!.scrollHeight;
        
                        this.status = data.state;
                    }
                    this.instance = false;
                },
                error:errorModal
            });
        }
    }

    public getState() : void{
        if(!this.instance){
            this.instance = true;
            $.ajax("../php/chatroom_process.php",{
                method:"post",
                dataType:"json",
                data:{
                    function:"getState",
                    file:this.file
                },
                success:(data)=>{
                    if(data.text){
                    for(let i =0;i<data.text.length;++i){
                        $("#chat-area").append(""+data.text[i]+"<br>");
                    }
                    document.getElementById('chat-area')!.scrollTop = document.getElementById('chat-area')!.scrollHeight;
                    this.status = data.state;
                    this.instance = false;
                    }
                }
            }); 
        }
    }

    public sendMsg(msg:string,username:string):void{
        this.update();
        $.ajax("../php/chatroom_process.php",{
            method:"post",
            dataType:"json",
            data:{
                function:"send",
                message:msg,
                username:username,
                file:this.file
            },
            success:()=>{this.update();}
        });
    }
}

$(()=>{
    let username = $("#username-box").text() as string;
    let chat = new Chat(username+".txt");
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
        setTimeout(Updating,1000);
    }
});

