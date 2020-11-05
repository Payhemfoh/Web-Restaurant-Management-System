import { inValidInput, validInput } from "./form_handle.js";
$(function () {
    //register ajax call(when register button is clicked)
    $("#btn_register").on("click", function (e) {
        //cancel default submit function
        e.preventDefault();
        //validate all input
        var fname = $("#fname").val().trim();
        var lname = $("#lname").val().trim();
        var gender = $("input[name='gender']:checked").val();
        console.log(gender);
        var birthday = $("#birthday").val().trim();
        var phone = $("#phone").val().trim();
        var email = $("#email").val().trim();
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var confirmPassword = $("#confirm_password").val().trim();
        var valid = true;
        //validation
        if (fname === "") {
            inValidInput($("#fname"), $("#fname-feedback"), "First Name should not be empty!");
            valid = false;
        }
        else {
            validInput($("#fname"), $("#fname-feedback"));
        }
        if (lname === "") {
            inValidInput($("#lname"), $("#lname-feedback"), "Last Name should not be empty!");
            valid = false;
        }
        else {
            validInput($("#lname"), $("#lname-feedback"));
        }
        if (gender == undefined) {
            inValidInput($("#gender"), $("#gender-feedback"), "Gender should not be empty!");
            valid = false;
        }
        else {
            validInput($("#gender"), $("#gender-feedback"));
        }
        if (birthday === "") {
            inValidInput($("#birthday"), $("#birthday-feedback"), "Date Of Birth should not be empty!");
            valid = false;
        }
        else {
            validInput($("#birthday"), $("#birthday-feedback"));
        }
        if (phone === "") {
            inValidInput($("#phone"), $("#phone-feedback"), "Phone No should not be empty!");
            valid = false;
        }
        else {
            validInput($("#phone"), $("#phone-feedback"));
        }
        if (email === "") {
            inValidInput($("#email"), $("#email-feedback"), "Email should not be empty!");
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
        if (username === "") {
            inValidInput($("#username"), $("#username-feedback"), "Username should not be empty!");
            valid = false;
        }
        else {
            validInput($("#username"), $("#username-feedback"));
        }
        if (password === "") {
            inValidInput($("#password"), $("#password-feedback"), "Password should not be empty!");
            valid = false;
        }
        else {
            validInput($("#password"), $("#password-feedback"));
        }
        if (confirmPassword === "") {
            inValidInput($("#confirm_password"), $("#confirmPassword-feedback"), "Confirm Password should not be empty!");
            valid = false;
        }
        else {
            if (confirmPassword === password) {
                validInput($("#confirm_password"), $("#confirmPassword-feedback"));
            }
            else if (password === "") {
                inValidInput($("#confirm_password"), $("#confirmPassword-feedback"), "Password is not filled!");
                valid = false;
            }
            else {
                inValidInput($("#confirm_password"), $("#confirmPassword-feedback"), "Password do not match the Confirm Password!");
                valid = false;
            }
        }
        if (valid) {
            //perform post ajax call using jquery
            $.ajax("../webpage/register.php", {
                type: "POST",
                //return datatype from the processing code
                dataType: "HTML",
                //the data to be passed to the processing code
                data: {
                    fname: fname,
                    lname: lname,
                    gender: gender,
                    birthday: birthday,
                    phone: phone,
                    email: email,
                    username: username,
                    password: password,
                    confirmPassword: confirmPassword
                },
                //action after the ajax call is success
                success: function (data, status, xhr) {
                    $("#modal-title").text("Register Status");
                    $(".modal-body").html(data);
                    $(".modal-footer").text("");
                    $("#btnAgain").attr("data-dismiss", "modal");
                    $("#modal").modal();
                },
                //action after the ajax call is failed
                error: function (xhr, status, error) {
                    if (xhr && xhr.status != 200) {
                        $("#modal-title").text("Error");
                        $(".modal-body").html("Failed to send request to server: <br> " + xhr.responseText + "<br>Please try again.<br>");
                        $(".modal-footer").text("<button id=\"cancel\" class=\"btn btn-primary" +
                            "btn-primaryLight btn-block\" data-dismiss=\"modal\">Cancel</button>");
                        $("#modal").modal();
                    }
                    else {
                        alert("Failed to send request to server! Please try again!");
                    }
                }
            });
        }
    });
});
