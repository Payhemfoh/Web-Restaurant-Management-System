import { errorModal } from "./errorFunction.js";
var Chat = /** @class */ (function () {
    function Chat(filename) {
        this.instance = false;
        this.status = 0;
        this.file = filename;
    }
    Object.defineProperty(Chat.prototype, "getInstance", {
        get: function () {
            return this.instance;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Chat.prototype, "getStatus", {
        get: function () {
            return this.status;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(Chat.prototype, "getFile", {
        get: function () {
            return this.file;
        },
        enumerable: false,
        configurable: true
    });
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
export { Chat };
