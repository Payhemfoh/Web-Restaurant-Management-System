import { getCookie, setCookie } from "./cookie_manupulation.js";
import { errorModal } from "./errorFunction.js";
$(function () {
    $(".btn-detail").on("click", function (e) {
        var id = parseInt(e.target.getAttribute("value"));
        var currentQty = parseInt(e.target.getAttribute("quantity"));
        //post ajax call to print the information
        $.ajax("../webpage/displayMenuDetail.php", {
            method: "POST",
            dataType: "HTML",
            data: {
                id: id,
                qty: currentQty
            },
            success: function (data) {
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                    'data-dismiss="modal">Return to Cart</button><br>' +
                    '<button id="changeQuantity" class="btn btn-primary btn-primaryLight btn-block" ' +
                    '>Apply Changes</button>');
                $("#modal").modal();
                $("#changeQuantity").on("click", function () {
                    var quantity = $("#orderQty").val();
                    var key = "orderList";
                    var fragment = getCookie(key);
                    var orderListObject;
                    if (fragment != null && fragment !== "") {
                        orderListObject = JSON.parse(fragment);
                        orderListObject.item.forEach(function (obj, index) {
                            if (obj.id === id) {
                                orderListObject.item[index].qty = parseInt(quantity);
                            }
                        });
                        setCookie(key + "=" + JSON.stringify(orderListObject) + ";path=/;");
                    }
                    $(".modal-body").html("Order Quantity Changed.");
                    $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                        'data-dismiss="modal">Return to menu list</button>');
                    $("#modal-cancel").on("click", function () { location.reload(); });
                });
            },
            error: errorModal
        });
    });
    $(".btn-delete").on("click", function (e) {
        var id = parseInt(e.target.getAttribute("value"));
        var currentQty = parseInt(e.target.getAttribute("quantity"));
        $.ajax("../webpage/displayMenuDetail.php", {
            method: "POST",
            dataType: "HTML",
            data: {
                id: id,
                qty: currentQty
            },
            success: function (data) {
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                    'data-dismiss="modal">Return to Cart</button><br>' +
                    '<button id="removeOrder" class="btn btn-primary btn-primaryLight btn-block" ' +
                    '>Remove From Cart</button>');
                $("#modal").modal();
                $("#removeOrder").on("click", function () {
                    var key = "orderList";
                    var fragment = getCookie(key);
                    var orderListObject;
                    if (fragment != null && fragment !== "") {
                        orderListObject = JSON.parse(fragment);
                        orderListObject.item = orderListObject.item.filter(function (value) { return value.id != id; });
                        setCookie(key + "=" + JSON.stringify(orderListObject) + ";path=/;");
                    }
                    $(".modal-body").html("Order Removed.");
                    $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                        'data-dismiss="modal">Return to menu list</button>');
                    $("#modal-cancel").on("click", function () { location.reload(); });
                });
            },
            error: errorModal
        });
    });
    $("#btn_checkout").on("click", function () {
        var username = $("#username").val();
        $.ajax({
            url: "../php/sendOrderToKitchen.php",
            method: "post",
            dataType: "html",
            data: { username: username },
            success: function (data) {
                console.log(data);
                var form = $("<form action='../webpage/payment.php'></form>");
                $("body").append(form);
                form.trigger("submit");
            },
            error: errorModal
        });
    });
    $("#btn_payment").on("click", function () {
        var form = $("<form action='../webpage/payment.php'></form>");
        $("body").append(form);
        form.trigger("submit");
    });
    $("#btn_sendKitchen").on("click", function () {
        var username = $("#username").val();
        $.ajax({
            url: "../php/sendOrderToKitchen.php",
            method: "post",
            dataType: "html",
            data: {
                username: username
            },
            success: function (data) {
                document.cookie = "orderList=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                $("#modal-title").text("Menu Information");
                $(".modal-body").html(data);
                $(".modal-footer").html('<button id="modal-cancel" class="btn btn-primary btn-primaryLight btn-block" ' +
                    'data-dismiss="modal">Return to Cart</button>');
                $("#modal").modal();
            },
            error: errorModal
        });
    });
});
