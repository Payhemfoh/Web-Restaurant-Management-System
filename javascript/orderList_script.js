import { errorModal } from "./errorFunction.js";
$(function () {
    setupWebpage();
});
function setupWebpage() {
    $(".category_row").on("click", function (e) {
        var id = e.target.getAttribute("value");
        displayMenu(id);
    });
    $(".nav_menu").on("click", function (e) {
        e.preventDefault();
        var id = e.target.getAttribute("value");
        $.ajax("../webpage/displayMenu.php", {
            method: "post",
            dataType: "html",
            data: { id: id },
            success: function (data) {
                $("#content").html(data);
                setupMenu();
            },
            error: errorModal
        });
    });
    $(".nav_main").on("click", function (e) {
        e.preventDefault();
        $.ajax("../webpage/categoryList.php", {
            method: "post",
            dataType: "html",
            success: function (data) {
                $("#content").html(data);
                setupWebpage();
            },
            error: errorModal
        });
    });
}
function displayMenu(id) {
    $.ajax("../webpage/displayMenu.php", {
        method: "post",
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
                        var fragment = getCookie(key);
                        var orderListObject;
                        if (fragment != null && fragment !== "") {
                            console.log(fragment);
                            orderListObject = JSON.parse(fragment);
                            orderListObject.item.push({ id: id, qty: quantity });
                        }
                        else {
                            orderListObject = { item: [{ id: id, qty: quantity }] };
                        }
                        setCookie(key + "=" + JSON.stringify(orderListObject) + ";path=/;");
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
    return fragment;
}
function setCookie(update) {
    console.log(update);
    document.cookie = update;
}
