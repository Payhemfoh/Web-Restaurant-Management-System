export {order, orderList, getCookie,setCookie};

interface order{
    id:number,
    qty:number
}

interface orderList{
    item:order[]
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
    document.cookie=update;
}