import { data } from "jquery";

$(()=>{
    let chat = new Chat();
    chat.update();
});

class Chat{
    private instance : boolean;
    private status : string;
    private file : string;

    constructor(){
        this.instance = false;
        this.status = "";
        this.file = "";
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
                success:(data)=>{if(data.text){
                    for(let i =0;i<data.text.length;++i){
                        $("#chat-area").append($(""+data.text[i]+""))
                    }
                    document.getElementById("chat-area")!.scrollTop = 
                    document.getElementById("chat-area")!.scrollHeight;
    
                    this.instance = false;
                    this.status = data.state;
                }}
            });
        }else{
            setTimeout(this.update,1000);
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
                    this.status = data.state;
                    this.instance = false;
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