export { getCookie, setCookie };
function getCookie(key) {
    var cookie = document.cookie;
    //get the beginning string of key in cookie 
    var begin = cookie.indexOf("; " + key + "=");
    //search the key in cookie
    if (begin === -1) {
        //if the key is first cookie
        begin = cookie.indexOf(key + "=");
        //if the key is not found
        if (begin != 0)
            return null;
    }
    //search the end of the key
    var end = cookie.indexOf(";", begin + 1);
    if (end === -1) {
        end = cookie.length;
    }
    var fragment = decodeURI(cookie.substring(cookie.indexOf("=", begin) + 1, end));
    return fragment;
}
function setCookie(update) {
    document.cookie = update;
}
