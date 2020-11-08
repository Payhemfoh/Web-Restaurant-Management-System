import { showPasswordSetting } from "./form_handle.js";
$(function () {
    $("#btn_eWallet").on("click", setEWalletPayment);
    $("#btn_card").on("click", setCardPayment);
    $("#btn_cash").on("click", setCashPayment);
});
function setCashPayment(e) {
    var service = e.target.getAttribute("value");
    if (service === "delivery") {
    }
    else {
        $("#paymentBlock").html("<h4>Your order id is XXXX.<br>" +
            "The total price is RMxx.xx.<br>" +
            "Please pay before exit the store." +
            "<br>Thank you</h4><br><br>");
    }
}
function setEWalletPayment() {
    $("#paymentBlock").html("\n    <label for=\"eWalletpaymentMethod\">Select E-Wallet:</label><br>\n    <div class='btn-group'>\n        <button class='btn btn-primary'>Touch 'N Go E-Wallet</button>\n        <button class='btn btn-primary'>Boost Pay</button>\n        <button class='btn btn-primary'>Grab Pay</button>\n        <button class='btn btn-primary'>Maybank2u Pay</button>\n        <button class='btn btn-primary'>PayPal</button>\n    </div>");
}
function setCardPayment() {
    $("#paymentBlock").html("\n    <label for=\"creditCardpaymentMethod\">Select Credit Card:</label><br>\n    <div class=\"btn-group\">\n        <button class=\"btn btn-primary pay_card\">Visa</button>\n        <button class=\"btn btn-primary pay_card\">Master</button>\n        <button class=\"btn btn-primary pay_card\">American Express</button>\n    </div>");
    $(".pay_card").on("click", creditPaymentForm);
}
function creditPaymentForm() {
    var html = $("#paymentBlock").html();
    html += "<form>\n    <div class=\"form-group\">\n        <lable for = \"cardNo\"><b>Card No:</b></label>\n        <div class=\"input-group mb-2 mr-sm-2\">\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"cardNo1\" name = \"cardNo1\" placeholder=\"xxxx\" maxlength=\"4\">\n            <div class=\"input-group-prepend\">\n                <div class=\"input-group-text\">-</div>\n            </div>\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"cardNo2\" name = \"cardNo2\" placeholder=\"xxxx\" maxlength=\"4\">\n            <div class=\"input-group-prepend\">\n                <div class=\"input-group-text\">-</div>\n            </div>\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"cardNo3\" name = \"cardNo3\" placeholder=\"xxxx\" maxlength=\"4\">\n            <div class=\"input-group-prepend\">\n                <div class=\"input-group-text\">-</div>\n            </div>\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"cardNo4\" name = \"cardNo4\" placeholder=\"xxxx\" maxlength=\"4\">\n        </div>\n    </div>\n\n    <div class=\"form-group\">\n        <lable for = \"expireDate\"><b>Expire date:</b></label>\n        <div class=\"input-group mb-2 mr-sm-2\">\n            <input type = \"text\" class=\"form-control col-md-2\" id = \"expireMonth\" name = \"expireMonth\" placeholder=\"mm\" maxlength=\"2\">\n            <div class=\"input-group-prepend\">\n                <div class=\"input-group-text\">/</div>\n            </div>\n            <input type = \"text\" class=\"form-control col-md-3\" id = \"expireYear\" name = \"expireYear\" placeholder=\"yyyy\" maxlength=\"4\">\n        </div>\n    </div>\n\n    <div class=\"form-group\">\n        <lable for = \"cvv\"><b>CVV/Security code:</b></label>\n        <input type = \"password\" class=\"form-control\" id = \"cvv\" name = \"cvv\">\n        <input type=\"checkbox\" id=\"showcvv\">Show CVV\n    </div>\n</form>";
    $("#paymentBlock").html(html);
    showPasswordSetting($("#cvv"), $("#showcvv"));
}
