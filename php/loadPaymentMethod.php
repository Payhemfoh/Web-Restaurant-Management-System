<?php
    $payment_method = $_POST['payment_method'];

    switch($payment_method){
        case "e-wallet":
            $ewallet_method = array("touchngo"=>"Touch 'N Go E-Wallet",
                                    "boost"=>"Boost Pay",
                                    "grab"=>"Grab Pay",
                                    "maybank"=>"Maybank2u Pay",
                                    "paypal"=>"PayPal");
            echo '<div class="container row">';
            foreach($ewallet_method as $key => $text){
                printf("<div class='col text-center'><input type='radio' value='$key' class='wallet_method' name='wallet_method'>$text</div>");
            }
            echo '</div>';
        break;
        case "card":
            $card_method = array("visa"=>"Visa",
                                "master"=>"Master",
                                "american_express"=>"American Express");
            echo '
                <label for="creditCardpaymentMethod">Select Credit Card:</label><br>
                <div class="container row">';
                foreach($card_method as $key => $text){
                    printf("<div class='col text-center'><input type='radio' value='$key' class='card_method' name='card_method'>$text</div>");
                }
                echo '</div>';
            
            echo '<form>
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
                    <input type = "password" class="form-control" id = "cvv" name = "cvv" maxlength="3">
                    <input type="checkbox" id="showcvv">Show CVV
                </div>
            </form>';
        break;
        case "cash":

        break;
    }
?>