import { Chat } from "./Chat.js";
$(function () {
    var username = $("#username-box").text();
    var delivery_id = $("#delivery_id").val();
    var chat = new Chat(username + "_" + delivery_id + ".txt");
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
    $("#btn_sendMsg").on("click", function (e) {
        e.preventDefault();
        var text = $("#msg").val();
        var max = parseInt($("#msg").attr("maxlength"));
        var length = text.length;
        if (length <= max + 1) {
            chat.sendMsg(text, username);
            $("#msg").val("");
        }
        else {
            $("#msg").val(text.substring(0, max));
        }
    });
    Updating();
    function Updating() {
        chat.update();
        setTimeout(Updating, 5000);
    }
});
