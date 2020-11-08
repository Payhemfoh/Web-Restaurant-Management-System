import { errorModal } from "./errorFunction.js";
import { inValidInput, showPasswordSetting, validInput } from "./form_handle.js";
$(function () {
    var submit = $("input[type='submit']");
    submit.on("click", function (e) {
        e.preventDefault();
        //get user input
        var username = $("#username").val().trim();
        var password = $("#pwd").val().trim();
        var valid = true;
        //validate user input
        if (username === "") {
            inValidInput($("#username"), $("#username-feedback"), "The username should not be empty!");
            valid = false;
        }
        else {
            validInput($("#username"), $("#username-feedback"));
        }
        if (password === "") {
            inValidInput($("#pwd"), $("#password-feedback"), "The password should not be empty!");
            valid = false;
        }
        else {
            validInput($("#pwd"), $("#password-feedback"));
        }
        //if all the input are valid, the post ajax call is performed to login_process.php
        if (valid) {
            $.ajax("../php/login_process.php", {
                type: "POST",
                //return data type is HTML
                dataType: "HTML",
                //data transferred to the process code
                data: {
                    username: username,
                    password: password
                },
                //action when request is success
                success: function (data, status, xhr) {
                    $("#modal-title").text("Login Status");
                    $(".modal-body").html(data);
                    $("#btnAgain").attr("data-dismiss", "modal");
                    $("#modal").modal();
                },
                //action when error is occured
                error: errorModal
            });
        }
    });
    showPasswordSetting($("#pwd"), $("#showpassword"));
});
