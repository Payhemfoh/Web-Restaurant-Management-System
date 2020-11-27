import { showPasswordSetting } from "./form_handle.js";
$(function () {
    loadOrder();
    $("#btn_eWallet").on("click", setEWalletPayment);
    $("#btn_card").on("click", setCardPayment);
    $("#btn_cash").on("click", setCashPayment);
    $("#complete-payment").on("click", function () {
        var service = $("#service").val();
        var orderId = $("#orderID").val();
        var price = $("#totalPrice").val();
        $.ajax({
            url: "../php/payment_process.php",
            method: "post",
            dataType: "html",
            data: { totalPrice: price },
            success: function (data) {
                $("#modal-title").text("Complete Payment");
                $(".modal-body").html(data);
                $(".modal-footer").html("");
                if (service === "delivery") {
                    $("#complete").on("click", function () {
                        var form = $("<form action='../webpage/setLocation.php'></form>");
                        $(".modal-body").append(form);
                        form.trigger("submit");
                    });
                }
                else {
                    $("#complete").on("click", function () {
                        var form = $("<form action='../webpage/homepage.php'></form>");
                        $(".modal-body").append(form);
                        setTimeout(function () { return form.trigger("submit"); }, 5000);
                    });
                }
                $("#modal").modal();
            }
        });
    });
});
function setCashPayment(e) {
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
}
function setEWalletPayment() {
    $("#paymentBlock").html("\n    <label for=\"eWalletpaymentMethod\">Select E-Wallet:</label><br>\n    <div class='container justify-content-center'>\n        <button class='btn btn-primary col-lg pay_wallet'>Touch 'N Go E-Wallet</button>\n        <button class='btn btn-primary col-lg pay_wallet'>Boost Pay</button>\n        <button class='btn btn-primary col-lg pay_wallet'>Grab Pay</button>\n        <button class='btn btn-primary col-lg pay_wallet'>Maybank2u Pay</button>\n        <button class='btn btn-primary col-lg pay_wallet'>PayPal</button>\n    </div><br><br>");
    $(".pay_wallet").on("click", walletPaymentForm);
}
function setCardPayment() {
    $("#paymentBlock").html("\n    <label for=\"creditCardpaymentMethod\">Select Credit Card:</label><br>\n    <div class=\"container justify-content-center\">\n        <button class=\"btn btn-primary col-lg pay_card\">Visa</button>\n        <button class=\"btn btn-primary col-lg pay_card\">Master</button>\n        <button class=\"btn btn-primary col-lg pay_card\">American Express</button>\n    </div><br><br>");
    $(".pay_card").on("click", creditPaymentForm);
}
function creditPaymentForm() {
    var html = $("#paymentBlock").html();
    html += "<form>\n    <div class=\"form-group\">\n        <lable for = \"cardNo\"><b>Card No:</b></label>\n        <div class=\"input-group mb-2 mr-sm-2\">\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"cardNo1\" name = \"cardNo1\" placeholder=\"xxxx\" maxlength=\"4\">\n            <div class=\"input-group-prepend\">\n                <div class=\"input-group-text\">-</div>\n            </div>\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"cardNo2\" name = \"cardNo2\" placeholder=\"xxxx\" maxlength=\"4\">\n            <div class=\"input-group-prepend\">\n                <div class=\"input-group-text\">-</div>\n            </div>\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"cardNo3\" name = \"cardNo3\" placeholder=\"xxxx\" maxlength=\"4\">\n            <div class=\"input-group-prepend\">\n                <div class=\"input-group-text\">-</div>\n            </div>\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"cardNo4\" name = \"cardNo4\" placeholder=\"xxxx\" maxlength=\"4\">\n        </div>\n    </div>\n\n    <div class=\"form-group\">\n        <lable for = \"expireDate\"><b>Expire date:</b></label>\n        <div class=\"input-group mb-2 mr-sm-2\">\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"expireMonth\" name = \"expireMonth\" placeholder=\"mm\" maxlength=\"2\">\n            <div class=\"input-group-prepend\">\n                <div class=\"input-group-text\">/</div>\n            </div>\n            <input type = \"text\" class=\"form-control col-md-3\" id = \"expireYear\" name = \"expireYear\" placeholder=\"yyyy\" maxlength=\"4\">\n        </div>\n    </div>\n\n    <div class=\"form-group\">\n        <lable for = \"cvv\"><b>CVV/Security code:</b></label>\n        <input type = \"password\" class=\"form-control\" id = \"cvv\" name = \"cvv\">\n        <input type=\"checkbox\" id=\"showcvv\">Show CVV\n    </div>\n</form>";
    $("#paymentBlock").html(html);
    showPasswordSetting($("#cvv"), $("#showcvv"));
}
function walletPaymentForm() {
    var html = $("#paymentBlock").html();
    html += "<div class='text-center'><img src='../images/Payment/e_wallet.png' class=\"img-thumbnail\"></div><br>";
    $("#paymentBlock").html(html);
}
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
