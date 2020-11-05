"use strict";
$(function () {
    var submit = $("input[type='submit']");
    submit.on("click", function (e) {
        e.preventDefault();
        //get user input
        var username = $("#username").val();
        var password = $("#pwd").val();
        //validate user input
        $.ajax("../php/login_process.php", {
            type: "POST",
            dataType: "HTML",
            data: {
                username: username,
                password: password
            },
            success: function () { },
            error: function () { },
        });
    });
});
