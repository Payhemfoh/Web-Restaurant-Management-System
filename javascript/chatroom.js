$(function () {
    var chat = new Chat();
    chat.update();
});
var Chat = /** @class */ (function () {
    function Chat() {
        this.instance = false;
        this.status = "";
        this.file = "";
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
                            $("#chat-area").append($("" + data.text[i] + ""));
                        }
                        document.getElementById("chat-area").scrollTop =
                            document.getElementById("chat-area").scrollHeight;
                        _this.instance = false;
                        _this.status = data.state;
                    }
                }
            });
        }
        else {
            setTimeout(this.update, 1000);
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
                    _this.status = data.state;
                    _this.instance = false;
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
