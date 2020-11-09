import { errorModal } from "./errorFunction.js";
var Chat = /** @class */ (function () {
    function Chat(filename) {
        this.instance = false;
        this.status = 0;
        this.file = filename;
    }
    Chat.prototype.update = function () {
        var _this = this;
        if (!this.instance) {
            this.instance = true;
            $.ajax("../php/chatroom_process.php", {
                method: "post",
                dataType: "json",
                data: {
                    function: "update",
                    state: this.status,
                    file: this.file
                },
                success: function (data) {
                    if (data.text) {
                        for (var i = 0; i < data.text.length; ++i) {
                            $("#chat-area").append("" + data.text[i] + "<br>");
                        }
                        document.getElementById("chat-area").scrollTop = document.getElementById("chat-area").scrollHeight;
                        _this.status = data.state;
                    }
                    _this.instance = false;
                },
                error: errorModal
            });
        }
    };
    Chat.prototype.getState = function () {
        var _this = this;
        if (!this.instance) {
            this.instance = true;
            $.ajax("../php/chatroom_process.php", {
                method: "post",
                dataType: "json",
                data: {
                    function: "getState",
                    file: this.file
                },
                success: function (data) {
                    if (data.text) {
                        for (var i = 0; i < data.text.length; ++i) {
                            $("#chat-area").append("" + data.text[i] + "<br>");
                        }
                        document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
                        _this.status = data.state;
                        _this.instance = false;
                    }
                }
            });
        }
    };
    Chat.prototype.sendMsg = function (msg, username) {
        var _this = this;
        this.update();
        $.ajax("../php/chatroom_process.php", {
            method: "post",
            dataType: "json",
            data: {
                function: "send",
                message: msg,
                username: username,
                file: this.file
            },
            success: function () { _this.update(); }
        });
    };
    return Chat;
}());
$(function () {
    var username = $("#username-box").text();
    var chat = new Chat(username + ".txt");
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
    Updating();
    function Updating() {
        chat.update();
        setTimeout(Updating, 1000);
    }
});
