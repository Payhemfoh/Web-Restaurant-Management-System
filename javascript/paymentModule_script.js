import { showPasswordSetting } from "./form_handle.js";
$(function () {
    loadOrder();
    $(".payment_method").on("change", function (e) {
        var value = e.target.getAttribute("value");
        $("#paymentBlock").html("");
        $("#complete-payment").css("display", "none");
        $.ajax({
            url: "../php/loadPaymentMethod.php",
            method: "post",
            dataType: "html",
            data: { payment_method: value },
            success: function (data) {
                $("#methodBlock").html(data);
                switch (value) {
                    case "e-wallet":
                        $(".wallet_method").on("click", function () {
                            $("#paymentBlock").html("<div class='text-center'><img src='../images/Payment/e_wallet.png' class=\"img-thumbnail\"></div>");
                            $("#complete-payment").css("display", "block");
                        });
                        break;
                    case "card":
                        $("#complete-payment").css("display", "block");
                        showPasswordSetting($("#cvv"), $("#showcvv"));
                        break;
                    case "cash":
                        var service = $("#service").val();
                        var orderId = $("#orderID").val();
                        var price = $("#totalPrice").val();
                        if (service === "delivery") {
                            $("#paymentBlock").html("<h4>Your order id is " + orderId + ".<br>" +
                                "The total price is RM" + price + "<br>" +
                                "Our staff will receive the payment when the order is arrived." +
                                "<br>Thank you</h4><br><br>");
                        }
                        else {
                            $("#paymentBlock").html("<h4>Your order id is " + orderId + ".<br>" +
                                "The total price is RM" + price + "<br>" +
                                "Please pay before exit the store." +
                                "<br>Thank you</h4><br><br>");
                        }
                        break;
                }
            }
        });
    });
    $("#complete-payment").on("click", function () {
        var service = $("#service").val();
        var payment_method = $(".payment_method:checked").val();
        var price = $("#totalPrice").val();
        $.ajax({
            url: "../php/payment_process.php",
            method: "post",
            dataType: "html",
            data: {
                payment_method: payment_method,
                totalPrice: price
            },
            success: function (data) {
                $("#modal-title").text("Complete Payment");
                $(".modal-body").html(data);
                $(".modal-footer").html("");
                if (service === "delivery") {
                    var form_1 = $("<form action='../webpage/setLocation.php'></form>");
                    $(".modal-body").append(form_1);
                    setTimeout(function () { return form_1.trigger("submit"); }, 5000);
                    $("#complete").on("click", function () {
                        form_1.trigger("submit");
                    });
                }
                else {
                    var form_2 = $("<form action='../webpage/homepage.php'></form>");
                    $(".modal-body").append(form_2);
                    setTimeout(function () { return form_2.trigger("submit"); }, 5000);
                    $("#complete").on("click", function () {
                        form_2.trigger("submit");
                    });
                }
                $("#modal").modal();
            }
        });
    });
});
function loadOrder() {
    var orderId = $("#orderId").val();
    $.ajax({
        url: "../php/loadOrderItem.php",
        method: "post",
        dataType: "html",
        data: { orderId: orderId },
        success: function (data) { return $("#order_item_list").html(data); }
    });
}
