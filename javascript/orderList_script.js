import { errorModal } from "./errorFunction.js";
$(function () {
    $(".category_row").on("click", function (e) {
        var id = parseInt(e.target.getAttribute("value"));
        displayMenu(id);
    });
});
function displayMenu(id) {
    $.ajax("../webpage/displayMenu.php", {
        method: "get",
        dataType: "html",
        data: { id: id },
        success: function (data) {
            $("#content").html(data);
            setupMenu();
        },
        error: errorModal
    });
}
function setupMenu() {
    $(".btnOrder").on("click", function () {
        var id = parseInt(this.getAttribute("value"));
        if (id != null) {
            $.ajax("../webpage/makeOrder.php", {
                method: "POST",
                dataType: "HTML",
                data: {
                    id: id
                },
                success: function (data, status, xhr) {
                    $("#modal-title").text("Menu Detail");
                    $(".modal-body").html(data);
                    $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                        'data-dismiss="modal">Cancel</button><br>' +
                        '<button id="modal-submit" class="btn btn-primary btn-primaryLight btn-block">Place Order</button>');
                    $("#modal-submit").on("click", function () {
                        var quantity = $("#orderQty").val();
                        var key = "orderList";
                        var setting = getCookie(key);
                        var orderListObject;
                        if (setting != null && setting.fragment !== "") {
                            orderListObject = JSON.parse(setting.fragment);
                            orderListObject.item.push({ id: id, qty: quantity });
                        }
                        else {
                            orderListObject = { item: [{ id: id, qty: quantity }] };
                        }
                        setCookie(setting, key + "=" + JSON.stringify(orderListObject));
                        $(".modal-body").html("Order Placed.");
                        $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                            'data-dismiss="modal">Return to menu list</button>');
                    });
                    $("#modal").modal();
                },
                error: errorModal
            });
        }
    });
}
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
    return { start: begin, end: end, fragment: fragment };
}
function setCookie(setting, update) {
    document.cookie = update;
}
