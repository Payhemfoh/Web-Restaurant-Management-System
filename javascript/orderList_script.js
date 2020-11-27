import { getCookie, setCookie } from "./cookie_manupulation.js";
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
                success: function (data) {
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
                            orderListObject = JSON.parse(fragment);
                            var index_1 = -1;
                            if (orderListObject.item.some(function (obj, value) { if (obj.id === id) {
                                index_1 = value;
                                return true;
                            } return false; })) {
                                var totalQuantity = orderListObject.item[index_1].qty;
                                orderListObject.item[index_1].qty = parseInt(totalQuantity) + parseInt(quantity);
                            }
                            else {
                                orderListObject.item.push({ id: id, qty: quantity });
                            }
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
