import { Chat } from "./Chat.js";
$(function () {
    var username = $("#username").val();
    var file = $("#chatFile").val();
    var chat = new Chat(file);
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
    $("#btn_arrived").on("click", orderArrived);
    Updating();
    function Updating() {
        chat.update();
        setTimeout(Updating, 5000);
    }
});
function orderArrived(e) {
    e.preventDefault();
    var delivery_id = $("#delivery_id").val();
    console.log(delivery_id);
    $.ajax({
        url: "../php/completeDelivery.php",
        method: "post",
        dataType: "html",
        data: { delivery_id: delivery_id },
        success: function (data) {
            console.log(data);
            $("#modal-title").text("Delivery Request Completed");
            $(".modal-body").html(data);
            $(".modal-footer").html("");
            $("#btnAgain").attr("data-dismiss", "modal");
            $("#btnAgain").on("click", function () {
                location.reload();
            });
            $("#modal").modal();
            setTimeout(function () { return $("#btnAgain").trigger("click"); }, 1000);
        }
    });
}
