import { errorModal } from "./errorFunction.js";

interface order{
    id:number,
    qty:number
}

interface orderList{
    item:order[]
}

$(()=>{
    setupWebpage();
});

function setupWebpage():void{
    $(".category_row").on("click",(e)=>{
        let id = e.target.getAttribute("value")!;
        displayMenu(id);
    });

    $(".nav_menu").on("click",(e)=>{
        e.preventDefault();
        let id = e.target.getAttribute("value");
        $.ajax("../webpage/displayMenu.php",{
            method:"post",
            dataType:"html",
            data:{id:id},
            success:(data)=>{
                $("#content").html(data);
                setupMenu();
            },
            error:errorModal
        });
    })

    $(".nav_main").on("click",(e)=>{
        e.preventDefault();
        $.ajax("../webpage/categoryList.php",{
            method:"post",
            dataType:"html",
            success:(data)=>{
                $("#content").html(data);
                setupWebpage();
            },
            error:errorModal
        });
    })
}

function displayMenu(id : string):void{
    $.ajax("../webpage/displayMenu.php",{
        method:"post",
        dataType:"html",
        data:{id:id},
        success:(data)=>{
            $("#content").html(data);
            setupMenu();
        },
        error:errorModal
    });
}

function setupMenu() : void{
    
    $(".btnOrder").on("click",function(){
        let id = parseInt(this.getAttribute("value")!);
        
        if(id!=null){
            $.ajax("../webpage/makeOrder.php",{
                method:"POST",
                dataType:"HTML",
                data:{
                    id:id
                },
                success:function(data,status,xhr){
                    $("#modal-title").text("Menu Detail");
                    $(".modal-body").html(data);
                    $(".modal-footer").html(
                        '<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" '+
                        'data-dismiss="modal">Cancel</button><br>'+
                        '<button id="modal-submit" class="btn btn-primary btn-primaryLight btn-block">Place Order</button>'
                    );

                    $("#modal-submit").on("click",function(){
                        let quantity = $("#orderQty").val() as number;
                        let key = "orderList";
                        let fragment = getCookie(key);
                        let orderListObject : orderList;

                        if(fragment!=null && fragment!==""){
                            console.log(fragment);
                            orderListObject = JSON.parse(fragment);
                            orderListObject.item.push({id:id,qty:quantity});
                        }else{
                            orderListObject = {item:[{id:id,qty:quantity}]};
                        }
                        setCookie(key+"="+JSON.stringify(orderListObject)+";path=/;");

                        $(".modal-body").html("Order Placed.");
                        $(".modal-footer").html(
                            '<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" '+
                            'data-dismiss="modal">Return to menu list</button>'); 
                    });
                    ($("#modal") as any).modal();
                },
                error:errorModal
            });
        }
    });
}

function getCookie(key:string)
    :string|null
{
    let cookie = document.cookie;
    //get the beginning string of key in cookie 
    let begin = cookie.indexOf("; "+key+"=");
    //search the key in cookie
    if(begin === -1){
        //if the key is first cookie
        begin = cookie.indexOf(key+"=");
        //if the key is not found
        if(begin != 0 ) return null;
    }
    //search the end of the key
    let end = cookie.indexOf(";",begin+1);
    if(end === -1){
        end = cookie.length;
    }
    let fragment = decodeURI(cookie.substring(cookie.indexOf("=",begin)+1,end));
    return fragment;
}

function setCookie(update:string):void{
    console.log(update);
    document.cookie=update;
}