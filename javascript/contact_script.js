import { errorModal } from "./errorFunction.js";
import { inValidInput, validInput } from "./form_handle.js";
$(function () {
    $("#send-mail").on("click", function (e) {
        e.preventDefault();
        //get user input
        var username = $("#username").val();
        var email = $("#email").val();
        var content = $("#content").val();
        var valid = true;
        if (username === "") {
            inValidInput($("username"), $("username-feedback"), "Username should not be empty!");
            valid = false;
        }
        else {
            validInput($("username"), $("username-feedback"));
        }
        if (email === "") {
            inValidInput($("email"), $("email-feedback"), "Email should not be empty!");
            valid = false;
        }
        else {
            //the regex to check email format
            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
                validInput($("#email"), $("#email-feedback"));
            }
            else {
                inValidInput($("#email"), $("#email-feedback"), "The email format is Invalid!");
                valid = false;
            }
        }
        if (content === "") {
            inValidInput($("content"), $("content-feedback"), "Content should not be empty!");
            valid = false;
        }
        else {
            validInput($("content"), $("content-feedback"));
        }
        if (valid) {
            $.ajax("../php/contact_process.php", {
                method: "post",
                dataType: "html",
                data: {
                    username: username,
                    email: email,
                    content: content
                },
                success: function (data) {
                    $("#contact_form").html(data);
                },
                error: errorModal
            });
        }
    });
});
