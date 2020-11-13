import { Chat } from "./Chat.js";
$(function () {
    var username = $("#username-box").text();
    var customer_username = $("#customer_username").val();
    var delivery_id = $("#delivery_id").val();
    var chat = new Chat(customer_username + "_" + delivery_id + ".txt");
    chat.getState();
    $("#msg").on("keyup", function (e) {
        if (e.key == "Enter") {
            var text = $("#msg").val();
            var max = parseInt($("#msg").attr("maxlength"));
            var length_1 = text.length;
            if (length_1 <= max + 1) {
                chat.sendMsg(text, username);
                $("#msg").val("");
            }
            else {
                $("#msg").val(text.substring(0, max));
            }
        }
    });
    $("btn_arrived").on("click", orderArrived);
    Updating();
    function Updating() {
        chat.update();
        setTimeout(Updating, 5000);
    }
});
function orderArrived() {
    var delivery_id = $("#delivery_id").val();
    $.ajax({
        url: "../php/completeDelivery.php",
        method: "post",
        dataType: "html",
        data: { delivery_id: delivery_id },
        success: function (data) {
            $("#modal-title").text("Delivery Request Completed");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#btnAgain").attr("data-dismiss", "modal");
            setTimeout(function () { return $("#btnAgain").trigger("click"); }, 1000);
        }
    });
}
