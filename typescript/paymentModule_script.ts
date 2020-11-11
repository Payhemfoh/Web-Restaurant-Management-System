import { showPasswordSetting } from "./form_handle.js";

$(()=>{
    $("#btn_eWallet").on("click",setEWalletPayment);
    $("#btn_card").on("click",setCardPayment);
    $("#btn_cash").on("click",setCashPayment);
});

function setCashPayment(e:JQuery.ClickEvent):void{
    let service = $("#service").val() as string;
    let orderId = $("#orderID").val() as number;
    let price = $("#totalPrice").val() as number;
    if(service === "delivery"){
        $("#paymentBlock").html("<h4>Your order id is "+orderId+".<br>"+
                                "The total price is RM"+price+"<br>"+
                                "Our staff will receive the payment when the order is arrived."+
                                "<br>Thank you</h4><br><br>");
    }else{
        $("#paymentBlock").html("<h4>Your order id is "+orderId+".<br>"+
                                "The total price is RM"+price+"<br>"+
                                "Please pay before exit the store."+
                                "<br>Thank you</h4><br><br>");
    }
}

function setEWalletPayment():void{
    $("#paymentBlock").html(`
    <label for="eWalletpaymentMethod">Select E-Wallet:</label><br>
    <div class='btn-group'>
        <button class='btn btn-primary pay_wallet'>Touch 'N Go E-Wallet</button>
        <button class='btn btn-primary pay_wallet'>Boost Pay</button>
        <button class='btn btn-primary pay_wallet'>Grab Pay</button>
        <button class='btn btn-primary pay_wallet'>Maybank2u Pay</button>
        <button class='btn btn-primary pay_wallet'>PayPal</button>
    </div>`);

    $(".pay_wallet").on("click",walletPaymentForm);
}

function setCardPayment():void{
    $("#paymentBlock").html(`
    <label for="creditCardpaymentMethod">Select Credit Card:</label><br>
    <div class="btn-group">
        <button class="btn btn-primary pay_card">Visa</button>
        <button class="btn btn-primary pay_card">Master</button>
        <button class="btn btn-primary pay_card">American Express</button>
    </div>`);

    $(".pay_card").on("click",creditPaymentForm);
}

function creditPaymentForm():void{
    let html = $("#paymentBlock").html()
    html += `<form>
    <div class="form-group">
        <lable for = "cardNo"><b>Card No:</b></label>
        <div class="input-group mb-2 mr-sm-2">
            <input type = "text" class="form-control col-md-2" id = "cardNo1" name = "cardNo1" placeholder="xxxx" maxlength="4">
            <div class="input-group-prepend">
                <div class="input-group-text">-</div>
            </div>
            <input type = "text" class="form-control col-md-2" id = "cardNo2" name = "cardNo2" placeholder="xxxx" maxlength="4">
            <div class="input-group-prepend">
                <div class="input-group-text">-</div>
            </div>
            <input type = "text" class="form-control col-md-2" id = "cardNo3" name = "cardNo3" placeholder="xxxx" maxlength="4">
            <div class="input-group-prepend">
                <div class="input-group-text">-</div>
            </div>
            <input type = "text" class="form-control col-md-2" id = "cardNo4" name = "cardNo4" placeholder="xxxx" maxlength="4">
        </div>
    </div>

    <div class="form-group">
        <lable for = "expireDate"><b>Expire date:</b></label>
        <div class="input-group mb-2 mr-sm-2">
            <input type = "text" class="form-control col-md-2" id = "expireMonth" name = "expireMonth" placeholder="mm" maxlength="2">
            <div class="input-group-prepend">
                <div class="input-group-text">/</div>
            </div>
            <input type = "text" class="form-control col-md-3" id = "expireYear" name = "expireYear" placeholder="yyyy" maxlength="4">
        </div>
    </div>

    <div class="form-group">
        <lable for = "cvv"><b>CVV/Security code:</b></label>
        <input type = "password" class="form-control" id = "cvv" name = "cvv">
        <input type="checkbox" id="showcvv">Show CVV
    </div>
</form>`;

    $("#paymentBlock").html(html);
    showPasswordSetting($("#cvv"),$("#showcvv"));
}

function walletPaymentForm():void{
    let html = $("#paymentBlock").html();
    html+= "<img src='../images/Payment/e_wallet.png' class=\"img-thumbnail\"><br>";
    $("#paymentBlock").html(html);
}